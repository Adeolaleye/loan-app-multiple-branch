<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Client;
use App\Payment;
use Carbon\Carbon;
use App\Mail\AgapeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Null_;

class InTenureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with('client','payment')->where('status','=', 1 && 3)->Orderby('created_at','desc')->get();
        dd($loans);
        $counter =$loans->count();
        return view('intenure.index', [
            'loans' => $loans,
            'counter' => $counter,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function makepayment(Request $request, $id)
    {
        //dd($id);
        $loan = Loan::with('client','payment')->where('id', $id)->first();
        // $payment = $loan->payment->payment_status->first();
        $paymentimes = Payment::where('loan_id',$id)->where('payment_status',1)->count();
        $unpaiddetails = Payment::where('loan_id',$id)->where('payment_status',0)->first(); 
        return view('intenure.payback', [
            'loan' => $loan,
            'paymentimes' => $paymentimes,
            'unpaiddetails' => $unpaiddetails,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paynow(Request $request, $id)
    {
        $request->validate([
            'amount_paid' => 'required|int|min:0',
        ]);
        $paymentdetails = Payment::with('client','loan')->where('loan_id',$id)->where('payment_status',0);
       
        $paymentdetail = Payment::with('client','loan')->where('loan_id',$id);
        $payment = $paymentdetails->first();
        $payments = $paymentdetails->get();
        $paymentcount = $paymentdetail->count();      
        $bb_forward = $payment->expect_pay - $request->amount_paid;
        if(($paymentdetail->sum('amount_paid') + $request->amount_paid) > $payment->loan->total_payback){
            return back()->with('error', 'Client cannot pay above expected amount');
        }

        if($payment->loan->tenure == $paymentcount && ($paymentdetail->sum('amount_paid') + $request->amount_paid < $payment->loan->total_payback)){
            $payment->amount_paid= $request->amount_paid;
            $payment->date_paid = Carbon::now();
            $payment->payment_purpose = 'loan payback';
            $payment->payment_status = 1;
            $payment->admin_incharge = Auth()->user()->name;
            $payment->loan->status = 3;
            $intrest_permonth = $payment->loan->intrest / $payment->loan->tenure;
            $last_intrest = $payment->loan->actual_profit + $intrest_permonth;
            $payment->loan->actual_profit = $last_intrest;
            $payment->loan->sum_of_allpayback = $paymentdetail->sum('amount_paid') + $request->amount_paid;
            $payment->client->status= 'tenure extended';
            $payment->save();
            $payment->loan->save();
            $payment->client->save();

            Payment::create([
                'client_id' => $request->client_id,
                'loan_id' => $id,
                'next_due_date' => Carbon::now()->addDay(30),
                'outstanding_payment' => $payment->outstanding_payment - $request->amount_paid,
                'expect_pay' => $bb_forward,
                'bb_forward' => $bb_forward,
                'payback_permonth' => $payment->payback_permonth,
                'payment_status' => 0,
            ]);

            $paymentimes = Payment::where('loan_id',$id)->where('payment_status',1)->count();
            $data = [
                'client_no'=> $payment->client->client_no,
                'name'=> $payment->client->name,
                'phone'=> $payment->client->phone,
                'total_payback'=> $payment->loan->total_payback,
                'tenure'=> $payment->loan->tenure,
                'loan_amount' => $payment->loan->loan_amount,
                'loan_duration' => $payment->loan->loan_duration,
                'intrest' => $payment->loan->intrest, 
                'disbursement_date' => $payment->loan->disbursement_date, 
                'total_amountpaid' => $payment->loan->sum_of_allpayback,
                'actual_profit' => $payment->loan->actual_profit,
                'amount_paid' => $request->amount_paid,
                'next_pay' => $payment->expect_pay,
                'monthly_payback' => $payment->payback_permonth,
                'no_of_time_paid' => $paymentimes,
                'outstanding' => $payment->outstanding_payment,
                'bb_forward' => $payment->bb_forward,
                'next_due_date' => $payment->next_due_date,
                'subject'=> 'New Payment made, but Tenure Extended',
                'type'=> 'payment extended',
                'date_paid' => $payment->date_paid,
                'admin_incharge'=> Auth()->user()->name,
                'date'=> Carbon::now(),

            ];
            Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
            return back()->with('message', 'Payment Made Successfully, But Payback not completed, Tenure Extended!');
        }

        if($paymentdetail->sum('amount_paid') + $request->amount_paid < $payment->loan->total_payback){
            $payment->amount_paid= $request->amount_paid;
            $payment->date_paid = Carbon::now();
            $payment->payment_purpose = 'loan payback';
            $payment->payment_status = 1;
            $payment->admin_incharge = Auth()->user()->name;
            $payment->loan->sum_of_allpayback = $paymentdetail->sum('amount_paid') + $request->amount_paid;
            $intrest_permonth = $payment->loan->intrest / $payment->loan->tenure;
            $last_intrest = $payment->loan->actual_profit + $intrest_permonth;
            $payment->loan->actual_profit = $last_intrest;
            $payment->save();
            $payment->loan->save();
    
            Payment::create([
                'client_id' => $request->client_id,
                'loan_id' => $id,
                'next_due_date' => Carbon::now()->addDay(30),
                'outstanding_payment' => $payment->outstanding_payment - $request->amount_paid,
                'expect_pay' => $payment->loan->monthly_payback + $bb_forward,
                'bb_forward' => $bb_forward,
                'payback_permonth' => $payment->payback_permonth,
                'payment_status' => 0,
            ]);
            $paymentimes = Payment::where('loan_id',$id)->where('payment_status',1)->count();
            $data = [
                'client_no'=> $payment->client->client_no,
                'name'=> $payment->client->name,
                'phone'=> $payment->client->phone,
                'total_payback'=> $payment->loan->total_payback,
                'tenure'=> $payment->loan->tenure,
                'loan_amount' => $payment->loan->loan_amount,
                'loan_duration' => $payment->loan->loan_duration,
                'intrest' => $payment->loan->intrest, 
                'disbursement_date' => $payment->loan->disbursement_date, 
                'total_amountpaid' => $payment->loan->sum_of_allpayback,
                'actual_profit' => $payment->loan->actual_profit,
                'amount_paid' => $request->amount_paid,
                'next_pay' => $payment->expect_pay,
                'monthly_payback' => $payment->payback_permonth,
                'no_of_time_paid' => $paymentimes,
                'outstanding' => $payment->outstanding_payment,
                'bb_forward' => $payment->bb_forward,
                'next_due_date' => $payment->next_due_date,
                'subject'=> 'New Payment made',
                'type'=> 'payment',
                'date_paid' => $payment->date_paid,
                'admin_incharge'=> Auth()->user()->name,
                'date'=> Carbon::now(),

            ];
            Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
            return back()->with('message', 'Payment Made Successfully');
        }

        if($paymentdetail->sum('amount_paid') + $request->amount_paid == $payment->loan->total_payback){
             
            $payment->amount_paid= $request->amount_paid;
            $payment->date_paid = Carbon::now();
            $payment->payment_purpose = 'loan payback';
            $payment->payment_status = 1;
            $payment->admin_incharge = Auth()->user()->name;
            $payment->loan->status = 2;
            $intrest_permonth = $payment->loan->intrest / $payment->loan->tenure;
            $last_intrest = $payment->loan->actual_profit + $intrest_permonth;
            $payment->loan->actual_profit = $last_intrest;
            $payment->loan->sum_of_allpayback = $paymentdetail->sum('amount_paid') + $request->amount_paid;
            $payment->client->status = 'out of tenure';
            $payment->save();
            $payment->loan->save();
            $payment->client->save();

            $paymentimes = Payment::where('loan_id',$id)->where('payment_status',1)->count();

            $data = [
                'client_no'=> $payment->client->client_no,
                'name'=> $payment->client->name,
                'phone'=> $payment->client->phone,
                'total_payback'=> $payment->loan->total_payback,
                'tenure'=> $payment->loan->tenure,
                'loan_amount' => $payment->loan->loan_amount,
                'loan_duration' => $payment->loan->loan_duration,
                'intrest' => $payment->loan->intrest, 
                'disbursement_date' => $payment->loan->disbursement_date, 
                'total_amountpaid' => $payment->loan->sum_of_allpayback,
                'actual_profit' => $payment->loan->actual_profit,
                'amount_paid' => $request->amount_paid,
                'monthly_payback' => $payment->payback_permonth,
                'no_of_time_paid' => $paymentimes,
                'subject'=> 'New/Last Payment made,',
                'type'=> 'payment completed',
                'date_paid' => $payment->date_paid,
                'admin_incharge'=> Auth()->user()->name,
                'date'=> Carbon::now(),

            ];
            Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));

            return back()->with('message', 'Payback Completed, Congratulations!');
        }
        
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
