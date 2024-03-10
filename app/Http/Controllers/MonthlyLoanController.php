<?php

namespace App\Http\Controllers;

use App\Client;
use Carbon\Carbon;
use App\MonthlyLoan;
use App\MonthlyPayment;
use Illuminate\Http\Request;

class MonthlyLoanController extends Controller
{
    public function index(Request $request)
    {
        $branchID  = $request->id;
        $monthlyLoans = MonthlyLoan::with('client','monthlypayment')->where('branch_id',$branchID)->Orderby('created_at','desc')->get();
        $counter = $monthlyLoans->count();
        return view('monthlyloan.index', 
        [
            'monthlyLoans' => $monthlyLoans,
            'counter' => $counter,
            'branchID' => $branchID
        ]); 
    }

    public function create(Request $request)
    {
        $branchID  = $request->id;
        $clients = Client::where(function ($query) {
                     $query->whereIn('status',['out of tenure', '0']);
                 })->where('branch_id', $branchID)
                 ->get();
        return view('monthlyloan.create', 
        [
            'clients' => $clients,
            'branchID' => $branchID
        ]); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|int',
            'loan_amount' => 'required|numeric|min:0',
            'form_payment' => 'required|int|min:0',
            'duration_in_days' => 'required|int|min:0',
            'interest_percent' => 'required|int|min:0',
        ]);
        {
        $loan_amount = $request->loan_amount;
        $interest = ($loan_amount * $request->interest_percent) / 100;
        $amount_disburse = $loan_amount - $interest;
        $daily_payback = $loan_amount/$request->duration_in_days;
        $branchID = $request->id;
        $viewType = $request->viewType;

        $MonthlyLoan = MonthlyLoan::create([
            'client_id' => $request->client_id,
            'branch_id' => $request->id,
            'form_payment' =>$request->form_payment,
            'loan_amount' => $request->loan_amount,
            'interest'=> $interest,
            'interest_percent'=> $request->interest_percent,
            'daily_payback' => $daily_payback,
            'duration_in_days' => $request->duration_in_days,
            'amount_disburse' => $amount_disburse,
            'actual_profit' => $request->form_payment,
            'monthly_profit' =>$request->form_payment,
            'yearly_profit' =>$request->form_payment,
            'purpose'=> 'Monthly Loan',
            'admin_incharge' => Auth()->user()->name,
        ]);

        $client = Client::whereId($request->client_id)->first();
        $client->status= 'in review';
        $client->save();
        
        $data = [
            'client_no'=> $client->client_no,
            'name'=> $client->name,
            'phone'=> $client->phone,
            'loan_amount' => $request->loan_amount,
            'interest'=> $interest,
            'loan_duration' => $request->loan_duration,
            'actual_profit'=> $request->form_payment,
            'interest_percent'=> $request->interest_percent,
            'amount_disburse' => $amount_disburse,
            'daily_payback' => $daily_payback,
            'subject' => 'New Monthly Loan Request',
            'type' => 'loan request',
            'admin_incharge'=> Auth()->user()->name,
            'date'=> Carbon::now(),
        ];
        //Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
        //Mail::to('info@agapeglobal.com.ng')->send(new AgapeEmail($data));
        return redirect(route('viewmonthlyloan', ['viewType' => $viewType,'id' => $branchID]))->with('message', 'Monthly Loan Request Sent');
        
        }
    }

    public function edit($id)
    {
        $branchID = request()->query('branchID');
        $viewType = request()->query('viewType');
        $monthlyloan = MonthlyLoan::with('client')->where('id', $id)->first();
        return view('monthlyloan.edit',['monthlyloan' => $monthlyloan,'viewType' => $viewType,'branchID' => $branchID]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|int',
            'loan_amount' => 'required|numeric|min:0',
            'duration_in_days' => 'required|int|min:0',
            'interest_percent' => 'required|int|min:0',
        ]);
        {
           
            $loan_amount = $request->loan_amount;
            $interest = ($loan_amount * $request->interest_percent) / 100;
            $amount_disburse = $loan_amount - $interest;
            $daily_payback = $loan_amount/20;
            $branchID = $request->branchID;
            $viewType = $request->viewType;

            $loan= MonthlyLoan::find($id);
            $loan->loan_amount=$request->loan_amount;
            $loan->interest=$interest;
            $loan->interest_percent=$request->interest_percent;
            $loan->daily_payback=$daily_payback;
            $loan->amount_disburse=$amount_disburse;
            $loan->purpose='Monthly Loan';
            $loan->save();
            
            $data = [
                'client_no'=> $loan->client->client_no,
                'name'=> $loan->client->name,
                'phone'=> $loan->client->phone,
                'loan_amount' => $request->loan_amount,
                'duration_in_days'=>$request->duration_in_days,
                'interest'=> $interest,
                'intrest_percent' => $request->interest_percent,
                'daily_payback' => $daily_payback,
                'subject'=> 'Monthly Loan Request Updated',
                'type'=> 'update loan request',
                'admin_incharge'=> Auth()->user()->name,
                'date'=> Carbon::now(),
            ];
            //Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
            //Mail::to('info@agapeglobal.com.ng')->send(new AgapeEmail($data));
            return redirect(route('viewmonthlyloan', ['id' => $branchID,'viewType' => $viewType]))->with('message', 'Monthly Loan Request Updated');
        }
    }

    public function disburse(Request $request)
    {
        $branchID = $request->branch_id;
        $viewType = $request->viewType;
        if(is_null($request->disbursement_date)){
            $disbursement_date = Carbon::now();
        }else{
            $disbursement_date = $request->disbursement_date;
        }
        if(date('d,M Y', strtotime($disbursement_date)) > date('d,M Y')){
            return back()->with('error', 'Disbursement Date cannot be greater than present Date');
        }
        $loan = MonthlyLoan::with('client')->whereId($request->loan_id)->first();
        $now = Carbon::parse($disbursement_date);
        $startpaymentdate = $now->nextWeekday();
        $endpaymentdate = $startpaymentdate->copy()->addWeekdays(20);
        $loan->pay_back_days = $startpaymentdate->format('d,M Y'). ' to ' .$endpaymentdate->format('d,M Y');
        $loan->status= 1;
        $loan->client->status= 'in tenure';
        $loan->admin_who_disburse = Auth()->user()->name;
        $loan->save();
        $loan->client->save();
        MonthlyPayment::create([
            'client_id' => $loan->client_id,
            'monthly_loan_id' => $loan->id,
            'branch_id' =>$branchID,
            'next_due_date' => $startpaymentdate,
            'outstanding_payment' => $loan->amount_disburse,
            'expect_pay' => $loan->daily_payback,
            'bb_forward' => 0.00,
            'payback_perday' => $loan->daily_payback,
            'payment_status' => 0,
        ]);
        
        $payment =  MonthlyPayment::with('client','monthlyloan')->where('monthly_loan_id',$request->loan_id)->where('branch_id',$branchID)->where('payment_status',0)->first();
        $data = [
            'client_no'=> $loan->client->client_no,
            'name'=> $loan->client->name,
            'phone'=> $loan->client->phone,
            'loan_amount' => $loan->loan_amount,
            'daily_payback' => $loan->daily_payback,
           'interest'=> $loan->interest,
            'outstanding'=> $payment->outstanding_payment,
            'next_due_date'=> $startpaymentdate,
           'subject'=> 'Loan Disbursed',
           'type'=> 'loan disbursement',
            'disbursement_date' => $disbursement_date,
            'admin_incharge'=> Auth()->user()->name,
            'date'=> Carbon::now(),
        ];
       // Mail::to('info@agapeglobal.com.ng')->send(new AgapeEmail($data));
       // Mail::to('theconsode@gmail.com')->send(new AgapeEmail($data));
        return redirect(route('viewmonthlyloan', ['id' => $branchID,'viewType' => $viewType]))->with('message', 'Monthly Loan Disbursed');
    }
}