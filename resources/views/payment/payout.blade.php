@extends('layouts.main') 
@section('title','Payout') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Payout History <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total payouts</span></h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('payment') }}">Payment</a>
                    </li>
                    <li class="breadcrumb-item">Payout</li>
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
                        <span>Here are all payment that went out.</span>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="btn-group pull-right" role="group" aria-label="Basic example">
                            <a href="{{ route('payment') }}" data-bs-toggle="tooltip" title="Payout History">
                                <button class="btn btn-secondary" type="button" title="View Full Details">View All Pay In</button>
                            </a>
                            {{-- <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#makepayment" data-bs-toggle="tooltip">Make Random Payment</button> --}}
                        </div>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Made To</th>
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
                        @foreach ($payouts as $payout)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $payout->client->name }}</td>
                            <td>{{ date('F', strtotime($payout->disbursement_date)) }}</td>
                            <td>{{ number_format($payout->loan_amount) }}</td>
                            <td>{{ $payout->purpose }}</td>
                            <td>{{ $payout->admin_who_disburse }}</td>
                            <td>{{ date('d, M Y h:i A', strtotime($payout->disbursement_date)) }}</td>
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
@include('payment.popup')
