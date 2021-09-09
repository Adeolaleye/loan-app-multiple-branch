<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Client;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with('client','payment')->Orderby('created_at','desc')->get();
        $counter = $loans->count();
        return view('loan.index', [
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
        $clients = Client::where('status', '=', Null)->get();
        return view('loan.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|int|max:255',
            'loan_amount' => 'required|int|min:0',
            'tenure' => 'required|string|min:1',
        ]);
        {
        $loan_amount = $request->loan_amount;
        $intrest = 5*$request->tenure /100 * $loan_amount;
        $total_payback = $intrest + $loan_amount;
        $monthly_payback = $total_payback / $request->tenure;
        $fp_amount = 5.99/100 * $loan_amount + 1000;
        $profit = $intrest + $fp_amount;
        $intrest_permonth = $intrest / $request->tenure;

        $Loan = Loan::create([
            'client_id' => $request->client_id,
            'loan_amount' => $request->loan_amount,
            'tenure'=>$request->tenure,
            'intrest'=> $intrest,
            'monthly_payback' => $monthly_payback,
            'total_payback'=> $total_payback,
            'fp_amount'=>$fp_amount,
            'fp_status'=>'Not paid',
            'purpose'=>'loan',
            'admin_incharge' => Auth()->user()->name,

        ]);
        $client = Client::whereId($request->client_id)->first();
        $client->status= 'in review';
        $client->save();
        
        // $data = [
        //     'name'=> $user->name,
        //     'phone'=> $user->phone,
        //     'password'=>$request->password,
        //     'subject'=> 'Welcome, '. $user->name .' to Agapeglobal',
        //     'type'=> 'welcome',
        //     'role'=> $user->role,
        //     'email'=> $user->email,
        // ];
        // //dd($data);
        // Mail::to($user->email)->send(new AgapeEmail($data));
        // $data = [
        //     'type'=> 'admin welcome',
        //     'subject'=> 'New Registration',
        //     'name'=> $user->name,
        //     'phone'=> $user->phone,
        //     'email'=> $user->email,
            
        // ];
        // Mail::to(Auth()->user()->email)->send(new AgapeEmail($data));

        return redirect(route('loan'))->with('message', 'Loan Request Sent');
    
    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loan = Loan::with('client','payment')->where('id', $id)->first();
        return view('loan.edit',compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disburse(Request $request)
    {
        {
        $loan = Loan::with('client','payment')->whereId($request->loan_id)->first();
        $loan->disbursement_date = Carbon::now();
        $loan->fp_status = (is_null($request->fp_status) ? 'Not paid' : 'Paid' );
        $loan->loan_duration = Carbon::now()->addMonth($loan->tenure);
        $loan->monthly_payback = $loan->total_payback / $loan->tenure;
        $loan->expected_profit = $loan->intrest + $loan->fp_amount;
        $loan->status= 1;
        $loan->actual_profit = $loan->fp_amount;
        $loan->client->status= 'in tenure';
        $loan->admin_who_disburse = Auth()->user()->name;
        $loan->save();
        $loan->client->save();
        
        Payment::create([
            'client_id' => $loan->client_id,
            'loan_id' => $loan->id,
            'next_due_date' => Carbon::now()->addDay(30),
            'outstanding_payment' => $loan->total_payback,
            'expect_pay' => $loan->total_payback / $loan->tenure,
            'bb_forward' => 0.00,
            'payback_permonth' => $loan->total_payback / $loan->tenure,
            'payment_status' => 0,
        ]);
        }
        return redirect(route('loan'))->with('message', 'Loan Disbursed');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|int|max:255',
            'loan_amount' => 'required|int|min:10',
            'tenure' => 'required|string|max:10',
        ]);
        {
        $loan_amount = $request->loan_amount;
        $intrest = 5*$request->tenure /100 * $loan_amount;
        $total_payback = $intrest + $loan_amount;
        $monthly_payback = $total_payback / $request->tenure;
        $fp_amount = 5.99/100 * $loan_amount + 1000;
        $profit = $intrest + $fp_amount;
        $intrest_permonth = $intrest / $request->tenure;

        $loan= Loan::find($id);
        $loan->loan_amount=$request->loan_amount;
        $loan->tenure=$request->tenure;
        $loan->intrest=$intrest;
        $loan->monthly_payback=$monthly_payback;
        $loan->total_payback=$total_payback;
        $loan->fp_amount=$fp_amount;
        $loan->save();
        
        // $data = [
        //     'name'=> $user->name,
        //     'phone'=> $user->phone,
        //     'password'=>$request->password,
        //     'subject'=> 'Welcome, '. $user->name .' to Agapeglobal',
        //     'type'=> 'welcome',
        //     'role'=> $user->role,
        //     'email'=> $user->email,
        // ];
        // //dd($data);
        // Mail::to($user->email)->send(new AgapeEmail($data));
        // $data = [
        //     'type'=> 'admin welcome',
        //     'subject'=> 'New Registration',
        //     'name'=> $user->name,
        //     'phone'=> $user->phone,
        //     'email'=> $user->email,
            
        // ];
        // Mail::to(Auth()->user()->email)->send(new AgapeEmail($data));

        return redirect(route('loan'))->with('message', 'Loan Request Updated');
    
    
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
