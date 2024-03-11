<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\MonthlyLoan;
use App\MonthlyPayment;
use Illuminate\Http\Request;

class inMonthlyTenureController extends Controller
{
    public function index(Request $request)
    {
        $branchID  = $request->id;
        $monthlyloans = MonthlyLoan::with('client', 'monthlypayment')
            ->where('branch_id', $branchID)
            ->whereIn('status',['1','3'])
            ->whereHas('client', function ($query) {
                $query->whereIn('status', ['in tenure', 'tenure extended']);
            })
            ->orderBy('created_at', 'desc')
            ->get();
        $counter = $monthlyloans->count();
        $counter = $monthlyloans->count();
        return view('monthlytenure.index', 
        [
            'monthlyloans' => $monthlyloans,
            'counter' => $counter,
        ]); 
    }

    public function makepayment(Request $request, $id)
    {
        $loan = MonthlyLoan::with('client','monthlypayment')->where('id', $id)->first();
        $branchID = $request->branchID;
        $viewType = $request->viewType;
        $paymentimes = MonthlyPayment::where('monthly_loan_id',$id)->where('payment_status',1)->count();
        $unpaiddetails = MonthlyPayment::where('monthly_loan_id',$id)->where('payment_status',0)->first(); 

        //dd($branchID,$viewType);
        return view('monthlytenure.payback', [
            'loan' => $loan,
            'paymentimes' => $paymentimes,
            'unpaiddetails' => $unpaiddetails,
            'branchID' => $branchID,
            'viewType' => $viewType,
        ]);
    }

    public function paynow(Request $request, $id)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:0',
        ]);
        $paymentdetails = MonthlyPayment::with('client','monthlyloan')->where('monthly_loan_id',$request->id)->where('payment_status','0');
        $paymentdetail = MonthlyPayment::with('client','monthlyloan')->where('monthly_loan_id',$request->id);
        $payment = $paymentdetails->first();
        $payments = $paymentdetails->get();
        $paymentcount = $paymentdetail->count();    

        $bb_forward = $payment->expect_pay - $request->amount_paid;
        // Start of condition for paying too much
        if(($paymentdetail->sum('amount_paid') + $request->amount_paid) > $payment->monthlyloan->loan_amount){
            return back()->with('error', 'Client cannot pay above expected amount');
        }
        // End of condition for paying too much
        // Start of Condition for payment made but does not equivalent to payback, Tenure Extended
        if($payment->monthlyloan->duration_in_days == $paymentcount && ($paymentdetail->sum('amount_paid') + $request->amount_paid < $payment->monthlyloan->loan_amount) or $payment->client->status == 'tenure extended' && ($paymentdetail->sum('amount_paid') + $request->amount_paid < $payment->monthlyloan->loan_amount)){
                $duedate = Carbon::parse($payment->next_due_date);
                $nextduedate = $duedate->nextWeekday();
                $payment->amount_paid = $payment->amount_paid + $request->amount_paid;
                $payment->date_paid = Carbon::now();
                $payment->monthlyloan->purpose = 'Monthly Loan payback';
                $payment->payment_status = 1;
                $payment->admin_incharge = Auth()->user()->name;
                $payment->monthlyloan->status = 3;
                // $payment->loan->sum_of_allpayback = $paymentdetail->sum('amount_paid') + $request->amount_paid;
                // $startpaymentdate = $now->nextWeekday();
                // $endpaymentdate = $startpaymentdate->copy()->addWeekdays(20);
                $payment->monthlyloan->sum_of_allpayback = $payment->monthlyloan->sum_of_allpayback + $request->amount_paid;
                $payment->client->status= 'tenure extended';
                $payment->save();
                $payment->monthlyloan->save();
                $payment->client->save();
            $outstanding = $payment->outstanding_payment - $request->amount_paid;
            MonthlyPayment::create([
                'client_id' => $request->client_id,
                'monthly_loan_id' =>$request->id,
                'branch_id' => $request->branchID,
                'next_due_date' => $nextduedate,
                'outstanding_payment' => $outstanding,
                'expect_pay' => $outstanding,
                'bb_forward' => $bb_forward,
                'payback_perday' => $payment->monthlyloan->daily_payback,
                'payment_status' => 0,
            ]);

            $paymentimes = MonthlyPayment::where('monthly_loan_id',$id)->where('payment_status',1)->count();
            // $data = [
            //     'client_no'=> $payment->client->client_no,
            //     'name'=> $payment->client->name,
            //     'phone'=> $payment->client->phone,
            //     'total_payback'=> $payment->loan->total_payback,
            //     'tenure'=> $payment->loan->tenure,
            //     'loan_amount' => $payment->loan->loan_amount,
            //     'loan_duration' => $payment->loan->loan_duration,
            //     'intrest' => $payment->loan->intrest, 
            //     'disbursement_date' => $payment->loan->disbursement_date, 
            //     'total_amountpaid' => $payment->loan->sum_of_allpayback,
            //     'actual_profit' => $payment->loan->actual_profit,
            //     'amount_paid' => $request->amount_paid,
            //     'next_pay' => $payment->expect_pay,
            //     'monthly_payback' => $payment->payback_permonth,
            //     'no_of_time_paid' => $paymentimes,
            //     'outstanding' => $payment->outstanding_payment,
            //     'bb_forward' => $payment->bb_forward,
            //     'next_due_date' => $nextduedate,
            //     'subject'=> 'New Payment made, but Tenure Extended',
            //     'type'=> 'payment extended',
            //     'date_paid' => $payment->date_paid,
            //     'admin_incharge'=> Auth()->user()->name,
            //     'date'=> Carbon::now(),

            // ];
            //Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
            //Mail::to('info@agapeglobal.com.ng')->send(new AgapeEmail($data));
            return back()->with('message', 'Payment Made Successfully, But Payback not completed, Tenure Extended!');
        }
        // End of Condition for payment made but does not equivalent to payback, Tenure Extended

        // Start of condition for payment, still In Tenure
        if($paymentdetail->sum('amount_paid') + $request->amount_paid < $payment->monthlyloan->loan_amount){
                $duedate = Carbon::parse($payment->next_due_date);
                $nextduedate = $duedate->nextWeekday();
                $payment->amount_paid = $payment->amount_paid + $request->amount_paid;
                $payment->date_paid = Carbon::now();
                $payment->monthlyloan->purpose = 'Monthly loan payback';
                $payment->payment_status = 1;
                $payment->admin_incharge = Auth()->user()->name;
                $payment->monthlyloan->sum_of_allpayback = $payment->monthlyloan->sum_of_allpayback + $request->amount_paid;
                $payment->save();
                $payment->monthlyloan->save();
          
            MonthlyPayment::create([
                'client_id' => $request->client_id,
                'monthly_loan_id' =>$request->id,
                'branch_id' => $request->branchID,
                'next_due_date' => $nextduedate,
                'outstanding_payment' => $payment->outstanding_payment - $request->amount_paid,
                'expect_pay' => $bb_forward + $payment->monthlyloan->daily_payback,
                'bb_forward' => $bb_forward,
                'payback_perday' => $payment->monthlyloan->daily_payback,
                'payment_status' => 0,
            ]);
            $paymentimes = MonthlyPayment::where('monthly_loan_id',$id)->where('payment_status',1)->count();
            $data = [
                // 'client_no'=> $payment->client->client_no,
                // 'name'=> $payment->client->name,
                // 'phone'=> $payment->client->phone,
                // 'total_payback'=> $payment->loan->total_payback,
                // 'tenure'=> $payment->loan->tenure,
                // 'loan_amount' => $payment->loan->loan_amount,
                // 'loan_duration' => $payment->loan->loan_duration,
                // 'intrest' => $payment->loan->intrest, 
                // 'disbursement_date' => $payment->loan->disbursement_date, 
                // 'total_amountpaid' => $payment->loan->sum_of_allpayback,
                // 'actual_profit' => $payment->loan->actual_profit,
                // 'amount_paid' => $request->amount_paid,
                // 'next_pay' => $payment->expect_pay,
                // 'monthly_payback' => $payment->payback_permonth,
                // 'no_of_time_paid' => $paymentimes,
                // 'outstanding' => $payment->outstanding_payment,
                // 'bb_forward' => $payment->bb_forward,
                // 'next_due_date' => $nextduedate,
                // 'subject'=> 'New Payment made',
                // 'type'=> 'payment',
                // 'date_paid' => $payment->date_paid,
                // 'admin_incharge'=> Auth()->user()->name,
                // 'date'=> Carbon::now(),

            ];
            //Mail::to('info@agapeglobal.com.ng')->send(new AgapeEmail($data));
            //Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
            return back()->with('message', 'Payment Made Successfully');
        }
        // End of condition for payment, still In Tenure

        // Start of condition for completing payback, Out of Tenure
        if($paymentdetail->sum('amount_paid') + $request->amount_paid == $payment->monthlyloan->loan_amount){
                $payment->amount_paid= $payment->amount_paid + $request->amount_paid;
                $payment->date_paid = Carbon::now();
                $payment->monthlyloan->purpose = 'Monthly loan payback';
                $payment->payment_status = 1;
                $payment->admin_incharge = Auth()->user()->name;
                $payment->monthlyloan->status = 2;
                $payment->monthlyloan->sum_of_allpayback = $payment->monthlyloan->sum_of_allpayback + $request->amount_paid;
                if($payment->monthlyloan->updated_at->format('m,Y') == date('m,Y')){
                    $payment->monthlyloan->monthly_profit = $payment->monthlyloan->interest;
                }
                if($payment->monthlyloan->updated_at->format('Y') == date('Y')){
                    $payment->monthlyloan->yearly_profit = $payment->monthlyloan->interest;
                }
                $payment->client->status = 'out of tenure';
                $payment->save();
                $payment->monthlyloan->save();
                $payment->client->save();

            $paymentimes = MonthlyPayment::where('monthly_loan_id',$id)->where('payment_status',1)->count();

            $data = [
                'client_no'=> $payment->client->client_no,
                'name'=> $payment->client->name,
                'phone'=> $payment->client->phone,
                'total_payback'=> $payment->monthlyloan->total_payback,
                'tenure'=> $payment->monthlyloan->tenure,
                'loan_amount' => $payment->monthlyloan->loan_amount,
                'loan_duration' => $payment->monthlyloan->loan_duration,
                'intrest' => $payment->monthlyloan->intrest, 
                'disbursement_date' => $payment->monthlyloan->disbursement_date, 
                'total_amountpaid' => $payment->monthlyloan->sum_of_allpayback,
                'actual_profit' => $payment->monthlyloan->actual_profit,
                'amount_paid' => $request->amount_paid,
                'monthly_payback' => $payment->payback_permonth,
                'no_of_time_paid' => $paymentimes,
                'subject'=> 'New/Last Payment made,',
                'type'=> 'payment completed',
                'date_paid' => $payment->date_paid,
                'admin_incharge'=> Auth()->user()->name,
                'date'=> Carbon::now(),

            ];
            //Mail::to('info@agapeglobal.com.ng')->send(new AgapeEmail($data));
            //Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
            return back()->with('message', 'Payback Completed, Congratulations!');
        }
        // End of condition for completing payback, Out of Tenure
        
    }
    public function partialpay(Request $request, $id)
    {
        $request->validate([
            'amount_paid' => 'required|int|min:0',
        ]);
        $payment = MonthlyPayment::with('client','monthlyloan')->where('monthly_loan_id',$id)->where('payment_status',0)->first();
        if(($request->amount_paid) > $payment->expect_pay){
            return back()->with('warning', 'Client cannot pay greater than expected pay as partial pay');
        }
        if(($request->amount_paid) == $payment->expect_pay){
            return back()->with('error', 'Use direct make payment option instead to complete payment for the month');
        }
        $payment->amount_paid= $payment->amount_paid + $request->amount_paid;
        $payment->partial_pay= $payment->partial_pay + $request->amount_paid;
        $payment->date_paid = Carbon::now();
        $payment->monthlyloan->purpose = 'partial payment';
        $payment->outstanding_payment = $payment->outstanding_payment - $request->amount_paid;
        $payment->expect_pay = $payment->expect_pay - $request->amount_paid;
        if($payment->monthlyloan->updated_at->format('m,Y') <> date('m,Y')){
        $payment->monthlyloan->monthly_profit = 0;
        }
        $payment->monthlyloan->sum_of_allpayback = $payment->monthlyloan->sum_of_allpayback + $request->amount_paid;
        $payment->save();
        $payment->monthlyloan->save();

        $data = [
            'client_no'=> $payment->client->client_no,
            'name'=> $payment->client->name,
            'phone'=> $payment->client->phone,
            'loan_amount' => $payment->monthlyloan->loan_amount,
            'amount_paid' => $request->amount_paid,
            'next_pay' => $payment->expect_pay,
            'partial_pay' => $payment->partial_pay,
            'total_amountpaid' => $payment->monthlyloan->sum_of_allpayback,
            'daily_payback' => $payment->monthlyloan->daily_payback,
            'outstanding' => $payment->outstanding_payment,
            'next_due_date' => $payment->next_due_date,
            'subject'=> 'Partial Payment Made for Daily Payback',
            'type'=> 'partial payment',
            'date_paid' => $payment->date_paid,
            'admin_incharge'=> Auth()->user()->name,
            'date'=> Carbon::now(),

        ];
        //Mail::to('info@agapeglobal.com.ng')->send(new AgapeEmail($data));
        //Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
        return back()->with('message', 'Partial Payment Made Successfully!');
    }
}
