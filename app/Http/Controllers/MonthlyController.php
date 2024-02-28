<?php

namespace App\Http\Controllers;
use App\Loan;
use App\Client;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Void_;

class MonthlyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthlyreports = Payment::whereMonth('next_due_date', date('m'))->with('client','loan')->where('payment_status',0)->Orderby('next_due_date','ASC')->get();
        $counter = $monthlyreports->count();
        return view('monthly.index', [
            'monthlyreports' => $monthlyreports,
            'counter' => $counter,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $tenureextendeds = Loan::with('client','payment')->where('status','<>',2)->get();
        $tenureextendeds = $tenureextendeds->filter(
            function($items){
                    if( Carbon::parse($items->disbursement_date)->addMonth($items->tenure)  <  Carbon::now() or $items->status == 3){
                        return $items; 
                    } 
            });
        $tenureextended_count = $tenureextendeds->count();
        return view('monthly.show', compact(
            'tenureextendeds',
            'tenureextended_count'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function defaulter()
    {
        $defaulters = Loan::with(['client', 'payment'])
            ->whereHas('payment', function ($query) {
                $query->whereRaw('MONTH(next_due_date) > MONTH(CURRENT_DATE())')
                    ->where('payment_status', 0)->Orderby('next_due_date','ASC');
            })
            ->whereHas('client', function ($query) {
                $query->where('status', 'in tenure');
            })->get();
        $defaulter_count = $defaulters->count();
            return view('monthly.defaulter', compact(
                'defaulters',
                'defaulter_count'
            ));
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