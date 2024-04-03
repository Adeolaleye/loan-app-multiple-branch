<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Branch;
use App\Client;
use App\Payment;
use Carbon\Carbon;
use App\MonthlyLoan;
use App\MonthlyPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

interface ViewTypes {
	const BusinessOffice = "BusinessOffice";
	const HeadQuarter = "HeadQuarter";
}
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

    public function session(){

        //dd(Auth::user()->branch_id,Auth::user()->email);
        if (Auth::check() && Auth::user()->branch_id == Null) {
            return $this->headQuarter();
        } else {
            return $this->businessOffice(Auth::user()->branch_id);
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    private function headQuarter()
    {
        $allclients_count = Client::count();
        $clientintenure_count = Loan::where('status', '=', 1)->orwhere('status', '=', 3)->count();
        $clienttenurextended_count = Loan::where('status', '=', 3)->count();
        $profit = Loan::count();
        
        $outstanding = Payment::where('payment_status',0)->get();

        $savings = Payment::where('payment_purpose','=','savings')->get();
        $allsavings = $savings->sum('outstanding_payment');

        $profit = Loan::all();
        $monthlyprofit = Loan::whereYear('updated_at',date('Y'))->whereMonth('updated_at', date('m'))->sum('monthly_profit');
        $yearlyprofit = Loan::whereYear('updated_at', date('Y'))->sum('yearly_profit');
        $allprofits = $profit->sum('actual_profit');
        $companyvalue = $outstanding->sum('outstanding_payment');
        $monthlyreports = Payment::whereMonth('next_due_date', date('m'))->with('client','loan')->where('payment_status',0)->take(3)->Orderby('next_due_date','ASC')->get();
        $tenureextendeds = Loan::with('client','payment')->where('status','<>',2)->get();
        $viewType = ViewTypes::HeadQuarter;
        $defaulters = Loan::with(['client', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->whereRaw('MONTH(next_due_date) > MONTH(CURRENT_DATE())')
                    ->where('payment_status', 0)->Orderby('next_due_date','ASC');
            })
            ->whereHas('client', function ($query) {
                $query->where('status', 'in tenure');
            })
            ->take(5)->get();
        $tenureextendeds = $tenureextendeds->filter(
            function($items){
                    if( Carbon::parse($items->disbursement_date)->addMonth($items->tenure)  <  Carbon::now() or $items->status == 3){
                        return $items; 
                    } 
            })->take(5);
        return view('dashboard', compact(
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
        ));
    }

    private function businessOffice($id)
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
        return view('business-office-dashboard', [
            'allclients_count' => $allclients_count,
            'clientintenure_count' => $clientintenure_count,
            'companyvalue' => $companyvalue,
            'allprofits' => $allprofits,
            'monthlyreports' => $monthlyreports,
            'monthlyprofit' => $monthlyprofit,
            'yearlyprofit' => $yearlyprofit,
            'clienttenurextended_count' => $clienttenurextended_count,
            'tenureextendeds' => $tenureextendeds,
            'defaulters' => $defaulters,
            'branchN' => $branchName,
            'dailyreports' => $dailyreports,
            'type' => $viewType,
            'id' => $branchID,
            'currentDate' => $currentDate,
        ]);
    }
}