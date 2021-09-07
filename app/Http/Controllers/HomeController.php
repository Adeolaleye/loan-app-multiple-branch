<?php

namespace App\Http\Controllers;

use App\Client;
use App\Loan;
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
        // $payable = Loan::with('user')->take(5)->get();
        // $clientintenure = VendorProduct::take(4)->get();
        
        return view('dashboard', compact(
            'allclients_count',
            'clientintenure_count',
            // 'packages_count',
            // 'packages',
            // 'products'
        ));
        return view('dashboard');
    }
}
