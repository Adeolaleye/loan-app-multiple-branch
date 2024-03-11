<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Client;
use App\MonthlyLoan;
use App\MonthlyPayment;
use Illuminate\Http\Request;

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
        $branchID = request()->query('id');
        $allclients_count = Client::count();
        $clientintenure_count = MonthlyLoan::where('status', '=', 1)->orwhere('status', '=', 3)->count();
        $viewType = ViewTypes::BusinessOffice; 
        $dailyreports = MonthlyPayment::whereMonth('next_due_date', date('m'))->with('client','monthlyloan')->where('payment_status',0)->take(3)->Orderby('next_due_date','ASC')->get();
        return view('business-office-dashboard', compact(
            'allclients_count',
            'clientintenure_count',
            'companyvalue',
            'allsavings',
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
        ));
    }
}
