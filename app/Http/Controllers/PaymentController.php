<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Client;
use App\Payment;
use Carbon\Carbon;
use App\MonthlyLoan;
use App\MonthlyPayment;
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
       $payments = Payment::with('client','loan')->where('payment_status',1)->orderBy('updated_at', 'desc')->get();
       $allData = $this->getFilterData($payments);
    //    $loans = Loan::where('fp_status','Paid')->get();
    //    $payment_counter = $payments->count();
    //    $loans_counter = $loans->count();
    //    $counter = $payment_counter + $loans_counter;
    //    $months = $this->getMonths();
    //    $years = array_combine(range( date('Y'), date('2020')), range(date('Y'), date('2020')));
        return view('payment.index', [
            'payments' => $allData['payments'],
            'loans' => $allData['loans'],
            'counter' => $allData['counter'],
            'months' => $allData['months'],
            'years'=> $allData['years'],
            ]);
    }

    public function monthlyPayInHistory()
    {
        $branchID = request()->query('id');
        $payments = MonthlyPayment::with('client', 'monthlyloan')
        ->where('payment_status', 1)
        ->whereHas('monthlyloan', function ($query) use ($branchID) {
            $query->where('branch_id', $branchID);
        })
        ->orderBy('updated_at', 'desc')
        ->get();
       $allData = $this->getFilterData($payments);
    //    $loans = Loan::where('fp_status','Paid')->get();
    //    $payment_counter = $payments->count();
    //    $loans_counter = $loans->count();
    //    $counter = $payment_counter + $loans_counter;
    //    $months = $this->getMonths();
    //    $years = array_combine(range( date('Y'), date('2020')), range(date('Y'), date('2020')));
        return view('payment.index', [
            'payments' => $allData['payments'],
            'loans' => $allData['loans'],
            'counter' => $allData['counter'],
            'months' => $allData['months'],
            'years'=> $allData['years'],
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payout()
    {
        $payouts = Loan::with('client')->where('status', '<>' ,0)->orderBy('disbursement_date', 'desc')->get();
        $counter = $payouts->count();
        return view('payment.payout', [
         'payouts' => $payouts,
         'counter' => $counter,
         ]);

    }
    public function monthlyPayout()
    {
        $branchID = request()->query('id');
        $payouts = MonthlyLoan::with('client')->where('status', '<>' ,0)->where('branch_id', $branchID)->orderBy('disbursement_date', 'desc')->get();
        $counter = $payouts->count();
        return view('payment.payout', [
         'payouts' => $payouts,
         'counter' => $counter,
         ]);

    }
    public function forwardPayment()
    {
        $forwardPayRecords = Loan::with('client','payment')->where('fp_status','Paid')->orderBy('disbursement_date', 'desc')->get();
        $counter = $forwardPayRecords->count();
        return view('payment.forwardpayment', [
         'forwardPayRecords' => $forwardPayRecords,
         'counter' => $counter,
         ]);

    }
    public function formPayment()
    {
        $formPayRecords = Loan::with('client','payment')->whereNotNull('formpayment')->orderBy('created_at', 'desc')->get();
        $counter = $formPayRecords->count();
        return view('payment.formpayment', [
         'formPayRecords' => $formPayRecords,
         'counter' => $counter,
         ]);

    }
    public function monthlyFormPayment()
    {
        $branchID = request()->query('id');
        $formPayRecords = MonthlyLoan::with('client','monthlypayment')->whereNotNull('form_payment')->where('branch_id', $branchID)->orderBy('created_at', 'desc')->get();
        $counter = $formPayRecords->count();
        return view('payment.formpayment', [
         'formPayRecords' => $formPayRecords,
         'counter' => $counter,
         ]);

    }
    public function filter(Request $request)
    {

        
        if(!is_null($request->branchID)){
        $payments = MonthlyPayment::whereYear('date_paid', $request->year)->whereMonth('date_paid', $request->month)->get();
        }else{
        $payments = Payment::whereYear('date_paid', $request->year)->whereMonth('date_paid', $request->month)->get();
        }
        $allData = $this->getFilterData($payments);
        // dd($allData['payments']);
        // $loans = Loan::where('fp_status','Paid')->get();
        // $payment_counter = $payments->count();
        // $loans_counter = $loans->count();
        // $counter = $payment_counter + $loans_counter;
        // $months = $this->getMonths();
        // $years = array_combine(range( date('Y'), date('2020')), range(date('Y'), date('2020')));

        return view('payment.index', [
            'payments' => $allData['payments'],
            'loans' => $allData['loans'],
            'counter' => $allData['counter'],
            'months' => $allData['months'],
            'years'=> $allData['years'],
            'selected_month'=> $request->month,
            'selected_year'=> $request->year,
            'branchID' => $request->branchID,
            'viewType' => $request->viewType,
            ]);
    }

    //This is to refactor cos we are going to be needing all this code in the index and filter functions, we no longer have to repeat it
    private function getFilterData($payments){
        $loans = Loan::where('fp_status','Paid')->get();
        $months = $this->getMonths();
        $years = array_combine(range( date('Y'), date('2020')), range(date('Y'), date('2020')));

        $data = [
            'months' => $months,
            'years' => $years,
            'loans' => $loans,
            'payment_counter' => $payments->count(),
            'loans_counter' => $loans->count(),
            'counter' => $payments->count() + $loans->count(),
            'payments' => $payments,
        ];

        return $data;
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
        //$payhistorys = Payment::with('loan','client')->where('loan_id', $id)->where('payment_status',1)->Orderby('updated_at','asc')->get();
        $payhistorys = Payment::with('loan','client')
            ->where('loan_id', $id)
            ->where(function ($query) {
                $query->where('payment_status', 1)
                    ->orWhere('partial_pay', '!=', 0); 
            }) 
            ->orderBy('updated_at', 'asc')
            ->get();
        $monthlypayhistorys = 
        $loanhistory = Loan::with('client','payment')->where('id', $id)->first();
        $counter = $payhistorys->count();
        return view('payment.payhistory',compact('payhistorys','loanhistory','counter'));
    }

    public function showMonthlyPayment($id)
    {
        $branchID = request()->query('branchID');
        $viewType = request()->query('viewType');
        $payhistorys = MonthlyPayment::with('monthlyloan','client')
            ->where('monthly_loan_id', $id)
            ->where(function ($query) {
                $query->where('payment_status', 1)
                    ->orWhere('partial_pay', '!=', 0); 
            }) 
            ->orderBy('updated_at', 'asc')
            ->get();
        $loanhistory = MonthlyLoan::with('client','monthlypayment')->where('id', $id)->first();
        $counter = $payhistorys->count();
        return view('payment.payhistory',compact('payhistorys','loanhistory','counter','branchID','viewType'));
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
