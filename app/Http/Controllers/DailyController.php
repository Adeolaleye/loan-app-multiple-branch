<?php

namespace App\Http\Controllers;

use App\Client;
use Carbon\Carbon;
use App\MonthlyLoan;
use App\MonthlyPayment;
use Illuminate\Http\Request;

class DailyController extends Controller
{
    public function index()
    {
        $branchID = request()->query('id');
        $currentDate = Carbon::now()->toDateString();
        $dailyreports = MonthlyPayment::whereDate('next_due_date', $currentDate)
            ->with('client', 'monthlyloan')
            ->where('payment_status', 0)
            ->whereHas('monthlyloan', function ($query) use ($branchID) {
                $query->where('branch_id', $branchID);
            })
            ->orderBy('next_due_date', 'ASC')
            ->get();
        $counter = $dailyreports->count();
        return view('daily.index', [
            'dailyreports' => $dailyreports,
            'counter' => $counter,
        ]);
    }

    public function dailyDefaulter()
    {
        $branchID = request()->query('id');
        $currentDate = Carbon::now()->toDateString();
        $defaulters = MonthlyLoan::with(['client', 'monthlypayment'])
            ->whereHas('monthlypayment', function ($query) use ($currentDate) {
                $query->whereDate('next_due_date','<',$currentDate)
                    ->where('payment_status', '0')
                    ->orderBy('next_due_date', 'ASC');
            })
            ->whereHas('client', function ($query) {
                $query->where('status', 'in tenure');
            })->where('branch_id', $branchID)
            ->get();
        $defaulter_count = $defaulters->count();
            return view('daily.defaulter', compact(
                'defaulters',
                'defaulter_count'
            ));
    }
    public function show()
    {
        $branchID = request()->query('id');
        $tenureextendeds = MonthlyLoan::with('client','monthlypayment')->where('status','<>',2)->where('branch_id', $branchID)->get();
        $tenureextendeds = MonthlyLoan::with('client','monthlypayment')->where('status','=',2)->where('branch_id', $branchID)->get();
        $tenureextendeds = $tenureextendeds->filter(
            function($items){
                    if( Carbon::parse($items->disbursement_date)->addDay($items->duration_in_days)  <  Carbon::now() or $items->status == 3){
                        return $items; 
                    } 
            });
        $tenureextended_count = $tenureextendeds->count();
        return view('daily.tenureextend', compact(
            'tenureextendeds',
            'tenureextended_count'
        ));
    }
}
