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
        $profit = Loan::count();
        
        $outstanding = Payment::where('payment_status',0)->get();
        $companyvalue = $outstanding->sum('outstanding_payment');

        $savings = Payment::where('payment_purpose','=','savings')->get();
        $allsavings = $savings->sum('outstanding_payment');

        $profit = Loan::all();
        $monthlyprofit = Loan::whereMonth('created_at', date('m'))->sum('actual_profit');
        //dd($monthlyprofit);
        // $from = date('2018-01-01');
        // $to = date('2018-05-02');
        // Reservation::
        // User::whereMonth('created_at', date('m'))
        // ->whereYear('created_at', date('Y'))
        // ->get(['name','created_at']);

        $allprofits = $profit->sum('actual_profit');

        $monthlyreports = Payment::whereMonth('next_due_date', date('m'))->with('client','loan')->where('payment_status',0)->take(3)->get();
        $monthreportcounter = $monthlyreports->count();

        // $payable = Loan::with('user')->take(5)->get();
        // $clientintenure = VendorProduct::take(4)->get();
        
        return view('dashboard', compact(
            'allclients_count',
            'clientintenure_count',
            'companyvalue',
            'allsavings',
            'allprofits',
            'monthlyreports',
            'monthlyprofit',
            'monthreportcounter',
        ));
        return view('dashboard');
    }
}
