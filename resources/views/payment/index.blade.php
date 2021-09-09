@extends('layouts.main') 
@section('title','Payment') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Pay in History <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total payments</span> </h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Payment</li>
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
                    <div class="col-md-6 col-sm-12">
                        <span>All payment made to Us</span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="btn-group pull-right" role="group" aria-label="Basic example">
                            <a href="{{ route('payout') }}" data-bs-toggle="tooltip" title="Payout History">
                                <button class="btn btn-secondary" type="button" title="View Full Details">View Payout</button>
                            </a>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#savemoney" data-bs-toggle="tooltip">Save Money</button>
                        </div>
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
                          <th>Made By</th>
                          <th>Month</th>
                          <th>Amount</th>
                          <th>Purpose</th>
                          <th>Admin in Charge</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php 
                        $i = 1;
                        @endphp
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                @if($payment->payment_purpose =='loan payback')
                                    {{ !is_null($payment->client->name) ? $payment->client->name : 'Not Available' }}
                                @endif
                                @if($payment->payment_purpose =='savings')
                                    By Admin in charge
                                @endif
                            </td>
                            <td>{{ date('F', strtotime($payment->date_paid)) }}</td>
                            <td>{{ $payment->amount_paid }}</td>
                            <td>{{ $payment->payment_purpose }}</td>
                            <td>{{ $payment->admin_incharge }}</td>
                            <td>{{ date('d, M Y', strtotime($payment->date_paid)) }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>

              {{-- forward payments --}}
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h5>Here are forward payments</h5>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="advance-7">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Made By</th>
                          <th>Month</th>
                          <th>Amount Paid</th>
                          <th>Admin who disbursed(in charge)</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php 
                        $i = 1;
                        @endphp
                        @foreach ($loans as $loan)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>Admin who disbursed</td>
                            <td>{{ date('F', strtotime($loan->disbursement_date)) }}</td>
                            <td>{{ $loan->fp_amount }}</td>
                            <td>{{ $loan->admin_who_disburse }}</td>
                            <td>{{ date('d, M Y', strtotime($loan->disbursement_date)) }}</td>
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
@include('payment.popup')
@endsection
