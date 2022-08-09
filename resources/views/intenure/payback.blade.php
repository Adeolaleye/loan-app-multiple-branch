@extends('layouts.main') 
@section('title','Loan') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('clientsintenure') }}">All Debtors</a></li>
                    <li class="breadcrumb-item">Payback</li>
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
                <div id="profile_picture" class="col-sm-2 col-md-2 col-lg-2 p-r-0">
                    @if($loan->client->profile_picture)
                        <img width="60px" src="{{ "/".$loan->client->profile_picture }}" class="b-r-half pull-right">
                        @else 
                        <img width="60px" src="/profile_pictures/avater.png" class="pull-right"> 
                    @endif
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5 padding-0">
                    <span class="f-14 f-w-600">Client ID : {{ $loan->client->client_no }}</span>
                    <a href="{{ route('viewclient',$loan->client->id) }}" data-bs-toggle="tooltip" title="View Client Details">
                        <h5 class="f-18"><span class="text-warning">{{ $loan->client->name }}'s</span> Payback</h5>
                    </a>
                    <span class="f-12">{{ $loan->client->phone }}</span>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-center" style="margin-left: -15px">
                    @if ($loan->status == 3)
                        <div class="span badge rounded-pill pill-badge-info pull-right">Tenure Extended</div>
                    @endif
                    @if ($loan->status == 2)
                        <div class="span badge rounded-pill pill-badge-secondary pull-right">Payment Completed</div>
                    @endif
                    @if ($loan->status == 1)
                        <div class="span badge rounded-pill pill-badge-success pull-right">In Tenure</div>
                    @endif
                </div>
            </div>
          </div>
          <div class="card-body">
            @include('includes.alerts')
                <div class="row">
                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 padding-0">
                        <h5 class="text-left f-16" id="name" style="margin-bottom: 0rem"></h5>
                        <span id="phone" class="f-12"></span>
                    </div>
                    <div id="client_status" class="col-3 col-sm-3 col-md-3 col-lg-3" style="margin-left: -15px">
                    </div>
                </div>
                <div class="row m-t-20 text-center">
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Loan Amount</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                &#x20A6;{{ number_format($loan->loan_amount)}}   
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Expected Intrest</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                &#x20A6;{{ number_format($loan->intrest)}}<br>
                                <span class="font-success f-12 f-w-300">{{$loan->intrest_percent}}% per month</span>   
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Forward Payment Amount</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                &#x20A6;{{ number_format($loan->fp_amount)}}   
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-warning" style="margin-bottom: 0rem">Total Payback</p>
                        <h3 class="f-14 f-w-600"><span>&#x20A6;{{ number_format($loan->total_payback) }}</span></h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Total Amount Paid</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                &#x20A6;{{ number_format($loan->sum_of_allpayback) }}   
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Tenure</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                {{ $loan->tenure}} months  
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">No of time Paid</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                {{ $paymentimes }}  
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Outstanding</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                            @foreach ($loan->payment as $payment)
                                @if ($payment->payment_status == 0 )
                                    &#x20A6;{{ number_format($payment->outstanding_payment) }}
                                @endif
                            @endforeach    
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Payback Per Month</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                &#x20A6;{{ number_format($loan->monthly_payback) }}   
                            </span>
                        </h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Our Current Total Profit</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                &#x20A6;{{ !is_null( number_format($loan->actual_profit)) ? number_format($loan->actual_profit) : '0' }}   
                            </span>
                        </h3>
                    </div>
                @if ($loan->client->status == 'in tenure' || $loan->client->status == 'tenure extended')
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Balance Brought Forward</p>
                        <h3 class="f-14 f-w-600"><span>
                            @foreach ($loan->payment as $payment)
                                @if ($payment->payment_status == 0 )
                                &#x20A6;{{ !is_null(number_format($payment->bb_forward)) ? number_format($payment->bb_forward) : '0.00' }}
                                @endif
                            @endforeach
                        </span></h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Expected Next Pay</p>
                        <h3 class="f-14 f-w-600"><span>
                            @foreach ($loan->payment as $payment)
                                @if ($payment->payment_status == 0 )
                                    &#x20A6;{{ number_format($payment->expect_pay) }}<br>
                                    {{-- {{ $payment->expect_pay }} --}}
                                    {{ isset($payment->expect_pay) ? date('d,M Y', strtotime($payment->expect_pay)) : 'Not Available' }}
                                @endif
                            @endforeach
                        </span></h3>
                    </div>
                    <div class="col-6 col-lg-3 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Next Due Date</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                {{ isset($unpaiddetails->next_due_date) ? date('d,M Y', strtotime($unpaiddetails->next_due_date)) : 'Not Available' }}
                            </span>
                        </h3>
                    </div>
                @endif
                </div>
                <hr>
                @if ($loan->client->status == 'tenure extended' || $loan->client->status == 'in tenure' )
                    @if(Auth::user()->role=='Branch Manager' || Auth::user()->role=='Super Admin' )
                    <div class="text-center">
                        <a class="f-18 text-muted" id="full" style="cursor:pointer">Make Payment</a><br>
                        <a id="partial" class="f-12 text-info" style="cursor:pointer">Make Partial Payment Instead <i class="fas fa-arrow-right"></i></a>
                    </div>
                        <form id="fullpay" class="f1" method="post" action="{{ route('paynow', $loan->id) }}">
                        @csrf
                            <div class="row g-3 mb-2 m-t-30">
                                <div class="col-md-6 offset-md-3">
                                <label class="form-label" for="amount">Amount</label>
                                <div class="input-group input-group-air"><span class="input-group-text">&#x20A6;</span>
                                    <input class="form-control" type="number" name="amount_paid" value="{{ $unpaiddetails->expect_pay}}"{{ old('amount_paid') }} required="">
                                    <input class="form-control" type="hidden" name="client_id" value="{{ $loan->client->id }}">
                                </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Make Payment</button>
                            </div>
                        </form>

                        <form id="partialpay" class="f1" method="post" action="{{ route('partialpay', $loan->id) }}" style="display: none">
                            @csrf
                                <div class="row g-3 mb-2 m-t-30">
                                    <div class="col-md-6 offset-md-3">
                                    <label class="form-label" for="amount">Amount (<span class="f-12 text-warning">Amount Paid this month is &#x20A6;{{ number_format($unpaiddetails->amount_paid)}}</span>)</label>
                                    <div class="input-group input-group-air"><span class="input-group-text">&#x20A6;</span>
                                        <input class="form-control" type="number" placeholder="1000" name="amount_paid" value=""{{ old('amount_paid') }} required="">
                                        <input class="form-control" type="hidden" name="client_id" value="{{ $loan->client->id }}">
                                    </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Pay Partial Payment for the month</button>
                                </div>
                        </form>
                    @endif
                @endif
          </div>
        </div>
      </div>
    </div>
</div>
<script>
    $(document).ready(function(){
      $("#partial").click(function(){
        $("#fullpay").hide(1000);
        $("#partialpay").show(1000);
      });
      $("#full").click(function(){
        $("#fullpay").show(1000);
        $("#partialpay").hide(1000);
      });
    });</script>
@endsection
