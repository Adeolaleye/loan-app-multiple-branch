@extends('layouts.main') 
@section('title','All Debtors') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Clients in Tenure <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total clients in tenure</span></h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">All Debitors</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-8 col-sm-12">
                        <span>Here is the details of all clients that are in tenure,</span>
                        <br>
                        <span>Note that clients in tenure cannot be given loan until the end of a tenure.</span>
                        <br>
                        <span>By default you have those oweing for a longtime, to have the recent debtors, filter with <b>#</b> arrow.</span>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts')
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                      <thead>
                        <tr>
                           <th>#</th>
                            <th>Client</th>
                            <th>Loan Amount (&#x20A6;)</th>
                            <th>Daily Pay</th>
                            <th>Duration</th>
                            <th>Next Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php 
                        $i = 1;
                        @endphp
                        @foreach ($monthlyloans as $loan )
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ $loan->client->name }}<br>
                                <span class="text-success">#{{ $loan->client->client_no }}</span>
                            </td>
                            <td>{{ number_format($loan->loan_amount) }}</td>
                            <td>{{ number_format($loan->daily_payback) }}</td>
                            <td>
                                {{ $loan->pay_back_days }}
                                
                            </td>
                            <td>
                                @foreach ($loan->monthlypayment as $payment)
                                @if ($payment->payment_status == 0 )
                                {{ date('d,M Y', strtotime($payment->next_due_date)) }}<br>
                                <span class="text-danger">Expected next pay is <b>{{$payment->expect_pay}}</b></span>
                                @endif
                                @endforeach 
                            </td>
                            <td>
                                @if ($loan->status == 3)
                                    <div class="span badge rounded-pill pill-badge-info pull-right">Tenure Extended</div>
                                @endif
                                @if ($loan->status == 0)
                                    <div class="span badge rounded-pill pill-badge-secondary pull-right">Payment Completed</div>
                                @endif
                                @if ($loan->status == 1)
                                    <div class="span badge rounded-pill pill-badge-success pull-right">In Tenure</div>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('makemonthlypayment', $loan->id) }}">
                                        <input type="hidden" name="branchID" value="{{$branchID}}">
                                        <input type="hidden" name="viewType" value="{{$viewType}}">
                                        <button class="btn btn-light text-warning" type="submit" data-bs-toggle="tooltip" title="View Full Details"> 
                                            <i class="fas fa-eye text-warning"></i>
                                        </button>
                                    </form> 
                                    @if (!is_null($loan->payment) && $loan->payment->sum('amount_paid') < $loan->total_payback)
                                        @if(Auth::user()->role=='Branch Manager' || Auth::user()->role=='Super Admin' )
                                            <form action="{{ route('makepayment', $loan->id) }}">
                                                <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                            </form>
                                        @endif 
                                    @endif
                                    @if ($viewType == 'BusinessOffice' && ($loan->client->status == 'in tenure' || $loan->client->status == 'tenure extended'))
                                            <form class="f1" method="post" action="{{ route('monthlypaynow',$loan->client->id) }}">
                                            @csrf
                                                <input type="hidden" value="{{$branchID}}" name="branchID">
                                                <input type="hidden" value="{{$viewType}}" name="viewType">
                                                <input type="hidden" value="client" name="route_type">
                                                <button class="btn btn-primary" type="submit">Pay Now</button>
                                            </form> 
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
        </div>
    </div>
  </div>
@endsection