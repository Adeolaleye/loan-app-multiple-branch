<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Client;
use Carbon\Carbon;
use App\MonthlyLoan;
use App\MonthlyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

interface ViewTypes {
	const BusinessOffice = "BusinessOffice";
	const HeadQuarter = "HeadQuarter";
}
class BusinessOfficeController extends Controller
{
    public function index($id)
    {
        $branch = Branch::find($id);
        $branchName = $branch ? $branch->name : null;
        $branchID = $branch->id;
        $allclients_count = Client::where('branch_id',$branchID)->count();
        $clienttenurextended_count = MonthlyLoan::where('status', '=', 3)->count();
        $outstanding = MonthlyPayment::where('payment_status',0)->where('branch_id',$branchID)->get();
        $companyvalue = $outstanding->sum('outstanding_payment');
        $clientintenure_count = MonthlyLoan::whereIn('status', [1, 3])->where('branch_id', $branchID)->count();
        $viewType = ViewTypes::BusinessOffice; 
        $profit = MonthlyLoan::where('branch_id',$branchID);
        $allprofits = $profit->sum('actual_profit');
        $monthlyreports = MonthlyPayment::whereMonth('next_due_date', date('m'))->with('client','monthlyloan')->where('payment_status',0)->take(3)->Orderby('next_due_date','ASC')->get();
        $monthlyprofit = MonthlyLoan::whereYear('updated_at',date('Y'))->whereMonth('updated_at', date('m'))->sum('monthly_profit');
        $yearlyprofit = MonthlyLoan::whereYear('updated_at', date('Y'))->sum('yearly_profit');
        
        $tenureextendeds = MonthlyLoan::with('client','monthlypayment')->where('status','=',2)->where('branch_id', $branchID)->take(3)->get();
        $tenureextendeds = $tenureextendeds->filter(
            function($items){
                    if( Carbon::parse($items->disbursement_date)->addDay($items->duration_in_days)  <  Carbon::now() or $items->status == 3){
                        return $items; 
                    } 
            });

        $currentDate = Carbon::now()->toDateString();
        $dailyreports = MonthlyPayment::whereDate('next_due_date', $currentDate)
            ->with('client', 'monthlyloan')
            ->where('payment_status', 0)
            ->whereHas('monthlyloan', function ($query) use ($branchID) {
                $query->where('branch_id', $branchID);
            })->take(3)
            ->orderBy('next_due_date', 'ASC')
            ->get();
        $defaulters = MonthlyLoan::with(['client', 'monthlypayment'])
            ->whereHas('monthlypayment', function ($query) use ($currentDate) {
                $query->whereDate('next_due_date', '<',$currentDate)
                    ->where('payment_status', '0')
                    ->orderBy('next_due_date', 'ASC');
            })
            ->whereHas('client', function ($query) {
                $query->where('status', 'in tenure');
            })->where('branch_id', $branchID)
            ->get();
        return view('business-office-dashboard', compact(
            'allclients_count',
            'clientintenure_count',
            'companyvalue',
            'allprofits',
            'monthlyreports',
            'monthlyprofit',
            'yearlyprofit',
            'clienttenurextended_count',
            'tenureextendeds',
            'defaulters',
            'branchName',
            'dailyreports',
            'viewType',
            'branchID',
            'currentDate',
        ));
    }
}
