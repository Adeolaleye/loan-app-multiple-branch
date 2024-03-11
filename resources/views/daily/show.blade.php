@extends('layouts.main') 
@section('title','Loan History') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h5>Tenure Extended Clients<br> <span class="f-14 font-bold text-warning">{{ $tenureextended_count }} Total clients tenure was extended </span></h5>
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
                        <table class="display" id="advance-2">
                            <thead>
                              <tr>
                                  <th>Client ID #</th>
                                  <th>Client Name</th>
                                  <th>Outstanding (&#x20A6;)</th>
                                  <th>Expected Pay(&#x20A6;)</th>
                                  <th>Next Due Date</th>
                                  <th>Duration</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenureextendeds as $tenureextended)
                                <tr>
                                    <td>{{ $tenureextended->client->client_no }}</td>
                                    <td>{{ $tenureextended->client->name }}</td>
                                        @foreach ($tenureextended->monthlypayment as $payment)
                                        @if ($payment->payment_status == 0 )
                                    <td>
                                        {{ number_format($payment->outstanding_payment) }}
                                    </td>
                                    <td>{{ number_format($payment->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($payment->next_due_date)) }}</td>
                                        @endif
                                        @endforeach 
                                    
                                    <td>{{ $tenureextended->loan_duration }}</td>
                                    {{-- <td>{{ date('d,M Y', strtotime($tenureextended->next_due_date)) }}</td> --}}
                                    <td>
                                        <form action="{{ route('makemonthlypayment', $tenureextended->id) }}">
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
