@extends('layouts.main') 
@section('title','Loan History') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h5>Daily Report <br> <span class="f-14 font-bold text-warning">{{ $counter }} Clients to pay in {{ date('F') }}</span></h5>
                    <div class="card-header-right">
                    </div>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Loan</li>
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
                        <span>Here is history of those owing for this month.</span>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts')
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                        <thead>
                            <tr>
                                <th>Client ID #</th>
                                <th>Client Name</th>
                                <th>Outstanding (&#x20A6;)</th>
                                <th>Expected Pay(&#x20A6;)</th>
                                <th>Next Due Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dailyreports as $dailyreport)
                                <tr>
                                    <td>{{ $dailyreport->client->client_no }}</td>
                                    <td>{{ $dailyreport->client->name }}</td>
                                    <td>{{ number_format($dailyreport->outstanding_payment) }}</td>
                                    <td>{{ number_format($dailyreport->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($dailyreport->next_due_date)) }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ route('makemonthlypayment', $dailyreport->monthly_loan_id) }}">
                                                <input type="hidden" name="branchID" value="{{$branchID}}">
                                                <input type="hidden" name="viewType" value="{{$viewType}}">
                                                <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                            </form> 
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