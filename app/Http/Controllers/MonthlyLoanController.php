<?php

namespace App\Http\Controllers;

use App\Client;
use Carbon\Carbon;
use App\MonthlyLoan;
use Illuminate\Http\Request;

class MonthlyLoanController extends Controller
{
    public function index(Request $request)
    {
        $branchID  = $request->id;
        $monthlyLoans = MonthlyLoan::with('client')->where('branch_id',$branchID)->Orderby('created_at','desc')->get();
        $counter = $monthlyLoans->count();
        return view('monthlytenure.index', 
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
        return view('monthlytenure.create', 
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
        $daily_payback = $loan_amount/20;
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
        return view('monthlytenure.edit',['monthlyloan' => $monthlyloan,'viewType' => $viewType,'branchID' => $branchID]);
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
}
