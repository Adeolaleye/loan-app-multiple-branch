<?php

namespace App\Http\Controllers;

use App\MonthlyLoan;
use Illuminate\Http\Request;

class inMonthlyTenureController extends Controller
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
        ]); 
    }

    public function monthlyLoan(Request $request){
        
    }
}
