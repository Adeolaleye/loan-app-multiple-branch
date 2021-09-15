<?php

namespace App\Http\Controllers;

use App\Client;
use App\Loan;
use App\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allclients_count = Client::count();
        $clientintenure_count = Loan::where('status', '=', 1)->orwhere('status', '=', 3)->count();
        $clienttenurextended_count = Loan::where('status', '=', 3)->count();
        $profit = Loan::count();
        
        $outstanding = Payment::where('payment_status',0)->get();

        $savings = Payment::where('payment_purpose','=','savings')->get();
        $allsavings = $savings->sum('outstanding_payment');

        $profit = Loan::all();
        $monthlyprofit = Loan::whereMonth('created_at', date('m'))->sum('actual_profit');
        $allprofits = $profit->sum('actual_profit');
        $companyvalue = $outstanding->sum('outstanding_payment') + $allprofits;
        $monthlyreports = Payment::whereMonth('next_due_date', date('m'))->with('client','loan')->where('payment_status',0)->take(3)->get();
        $monthreportcounter = $monthlyreports->count();
        
        return view('dashboard', compact(
            'allclients_count',
            'clientintenure_count',
            'companyvalue',
            'allsavings',
            'allprofits',
            'monthlyreports',
            'monthlyprofit',
            'monthreportcounter',
            'clienttenurextended_count',
        ));
        return view('dashboard');
    }
}
