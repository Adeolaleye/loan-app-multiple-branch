<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Client;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $payments = Payment::with('client','loan')->where('payment_status',1)->get();
       $loans = Loan::where('fp_status','Paid')->get();
       $payment_counter = $payments->count();
       $loans_counter = $loans->count();
       $counter = $payment_counter + $loans_counter;
       return view('payment.index', [
        'payments' => $payments,
        'loans' => $loans,
        'counter' => $counter,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payout()
    {
        $payouts = Loan::with('client')->where('status', '<>' ,0)->get();
        $counter = $payouts->count();
        return view('payment.payout', [
         'payouts' => $payouts,
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
        $request->validate([
            'amount_paid' => 'required|int|min:0',
        ]
        
        );

        $payment = Payment::create([
            'amount_paid' => $request->amount_paid,
            'outstanding_payment' => $request->amount_paid,
            'payment_status' => 1,
            'date_paid' => Carbon::now(),
            'payment_purpose'=>'savings',
            'admin_incharge' => Auth()->user()->name,

        ]);
         return redirect(route('payment'))->with('message', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payhistorys = Payment::with('loan','client')->where('loan_id', $id)->where('payment_status',1)->Orderby('updated','asc')->get();
        $loanhistory = Loan::with('client','payment')->where('id', $id)->first();
        $counter = $payhistorys->count();
        return view('payment.payhistory',compact('payhistorys','loanhistory','counter'));
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
    public function update(Request $request, $id)
    {
        //
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
