<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Client;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InTenureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::with('client','payment')->where('status', 1)->Orderby('created_at','desc')->get();
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
        
        return view('intenure.payback', compact('loan'));
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
            'amount_paid' => 'required|int',
        ]);
        $payment = Payment::with('client','loan')->where('loan_id',$id)->first();
        $expectpay = $payment->loan->monthly_payback;
        $payment->amount_paid= $request->amount_paid;
        $payment->date_paid = Carbon::now();
        $payment->payment_status = 1;
        $payment->save();
        $bb_forward = $expectpay - $request->amount_paid;

        Payment::create([
            'client_id' => $request->client_id,
            'loan_id' => $id,
            'next_due_date' => Carbon::now()->addDay(30),
            'outstanding_payment' => $payment->outstanding_payment - $request->amount_paid,
            'expect_pay' => $payment->loan->monthly_payback + $bb_forward,
            'bb_forward' => $bb_forward,
            'payment_status' => 0,
        ]);
        return redirect(route('clientsintenure'))->with('message', 'Payment Made Successfully');
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
