@extends('layouts.main') 
@section('title','Loan History') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h5>Defaulters in the past days<br> <span class="f-14 font-bold text-warning">{{ $defaulter_count }} Total defaulters </span></h5>
                    <div class="card-header-right">
                    </div>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Debtors</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="user-status table-responsive">
                        <table class="display" id="advance-1">
                            <thead>
                              <tr>
                                  <th>Client ID #</th>
                                  <th>Client Name</th>
                                  <th>Outstanding (&#x20A6;)</th>
                                  <th>Expected Pay(&#x20A6;)</th>
                                  <th>Next Due Date</th>
                                  <th>Duration</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($defaulters as $defaulter)
                                <tr>
                                    <td>{{ $defaulter->client->client_no }}</td>
                                    <td>{{ $defaulter->client->name }}</td>
                                        @foreach ($defaulter->monthlypayment as $payment)
                                        @if ($payment->payment_status == 0 )
                                    <td>
                                        {{ number_format($payment->outstanding_payment) }}
                                    </td>
                                    <td>{{ number_format($payment->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($payment->next_due_date)) }}</td>
                                        @endif
                                        @endforeach 
                                    
                                    <td>{{ $defaulter->duration_in_days}}</td>
                                    <td>
                                    @if ($defaulter->client->status == 'in tenure')
                                    <div class="span badge rounded-pill pill-badge-success pull-right">In Tenure</div>
                                    @else
                                    <div class="span badge rounded-pill pill-badge-dark pull-right">Unknown</div>
                                    @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('makemonthlypayment', $defaulter->id) }}">
                                                <input type="hidden" name="branchID" value="{{$branchID}}">
                                                <input type="hidden" name="viewType" value="{{$viewType}}">
                                                <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form> 
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
  </div>
@endsection
