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
                        <img width="50px" src="{{ "/".$loan->client->profile_picture }}" class="b-r-half pull-right">
                        @else 
                        <img width="50px" src="/profile_pictures/avater.png" class="pull-right"> 
                    @endif
                </div>
                <div class="col-sm-12 col-md-5 col-lg-5 padding-0">
                    <a href="{{ route('viewclient',$loan->client->id) }}" data-bs-toggle="tooltip" title="View Client Details"><h5><span class="text-warning">{{ $loan->client->name }}'s</span> Payback</h5></a>
                    <span class="f-12">{{ $loan->client->phone }}</span>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-3 text-center" style="margin-left: -15px">
                    @if ($loan->status == 0)
                        <div class="span badge rounded-pill pill-badge-warning pull-right">In Review</div>
                    @endif
                    @if ($loan->status == 1)
                        <div class="span badge rounded-pill pill-badge-secondary pull-right">Disbursed</div>
                    @endif
                </div>
            </div>
          </div>
          <div class="card-body">
            @include('includes.alerts')
            <form class="f1" method="post" action="{{ route('paynow', $loan->id) }}">
              @csrf
                <div class="row">
                    <div class="col-7 col-sm-7 col-md-7 col-lg-7 padding-0">
                        <h5 class="text-left f-16" id="name" style="margin-bottom: 0rem"></h5>
                        <span id="phone" class="f-12"></span>
                    </div>
                    <div id="client_status" class="col-3 col-sm-3 col-md-3 col-lg-3" style="margin-left: -15px">
                    </div>
                </div>
                <div class="row m-t-20 text-center">
                    <div class="col-lg-2 col-sm-12 text-center">
                        <p class="f-14 text-warning" style="margin-bottom: 0rem">Total Payback</p>
                        <h3 class="f-14 f-w-600"><span># {{ $loan->total_payback }}</span></h3>
                    </div>
                    <div class="col-lg-2 col-sm-12 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Expect Pay This Month</p>
                        <h3 class="f-14 f-w-600"><span>
                            @foreach ($loan->payment as $payment)
                            @if ($payment->payment_status == 0 )
                                #{{ round($payment->expect_pay,1) }}<br>
                                {{-- {{ $payment->expect_pay }} --}}
                            @endif
                            @endforeach
                        </span></h3>
                    </div>
                    <div class="col-lg-2 col-sm-12 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Outstanding</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                            @foreach ($loan->payment as $payment)
                            @if ($payment->payment_status == 0 )
                                {{ $payment->outstanding_payment }}
                            @endif
                            @endforeach    
                            </span>
                        </h3>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Payback Per Month</p>
                        <h3 class="f-14 f-w-600">
                            <span>
                                {{ round($loan->monthly_payback,1) }}   
                            </span>
                        </h3>
                    </div>
                    <div class="col-lg-3 col-sm-12 text-center">
                        <p class="f-14 text-success" style="margin-bottom: 0rem">Balance Brought Forward</p>
                        <h3 class="f-14 f-w-600"><span>
                            @foreach ($loan->payment as $payment)
                            @if ($payment->payment_status == 0 )
                                {{ !is_null($payment->bb_forward) ? '#'.$payment->bb_forward : '0.00' }}
                            @endif
                            @endforeach
                        </span></h3>
                    </div>
                </div>
                <div class="row g-3 mb-2 m-t-30">
                    <div class="col-md-6 offset-md-3">
                      <label class="form-label" for="amount">Amount</label>
                      <div class="input-group input-group-air"><span class="input-group-text">#</span>
                        <input class="form-control" type="number" placeholder="50000" name="amount_paid" value="#{{ round($payment->expect_pay,1) }}"{{ old('amount_paid') }} required="">
                        <input class="form-control" type="hidden" name="client_id" value="{{ $loan->client->id }}">
                      </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
