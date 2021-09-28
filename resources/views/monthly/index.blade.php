@extends('layouts.main') 
@section('title','Loan History') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h5>Monthly Report <br> <span class="f-14 font-bold text-warning">{{ $counter }} Clients to pay in {{ date('F') }}</span></h5>
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
                                <th>Duration</th>
                                <th>Next Due Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monthlyreports as $monthlyreport)
                                <tr>
                                    <td>{{ $monthlyreport->client->client_no }}</td>
                                    <td>{{ $monthlyreport->client->name }}</td>
                                    <td>{{ number_format($monthlyreport->outstanding_payment) }}</td>
                                    <td>{{ number_format($monthlyreport->expect_pay) }}</td>
                                    <td>
                                        {{-- @foreach ($monthlyreport->loan as $loan )
                                        {{ $loan->loan_duration }}
                                        @endforeach --}}
                                    </td>
                                    <td>{{ date('d,M Y', strtotime($monthlyreport->next_due_date)) }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ route('makepayment', $monthlyreport->loan_id) }}">
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
