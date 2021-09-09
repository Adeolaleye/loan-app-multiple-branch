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
        $clientintenure_count = Loan::where('status', '=', 1)->count();
        $profit = Loan::count();
        
        $outstanding = Payment::where('payment_status',0)->get();
        $companyvalue = $outstanding->sum('outstanding_payment');

        $savings = Payment::where('payment_purpose','=','savings')->get();
        $allsavings = $savings->sum('outstanding_payment');

        $profit = Loan::all();
        $allprofits = $profit->sum('actual_profit');

        $monthlyreports = Payment::with('client','loan')->where('payment_status',0)->where('payment_purpose','=','loan payback')->take(3)->get();

        // $payable = Loan::with('user')->take(5)->get();
        // $clientintenure = VendorProduct::take(4)->get();
        
        return view('dashboard', compact(
            'allclients_count',
            'clientintenure_count',
            'companyvalue',
            'allsavings',
            'allprofits',
            'monthlyreports',
        ));
        return view('dashboard');
    }
}
