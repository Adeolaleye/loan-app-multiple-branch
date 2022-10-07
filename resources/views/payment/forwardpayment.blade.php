@extends('layouts.main') 
@section('title','Payment') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Forward Payment History <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total payments</span> </h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('payment')  }}">Payment</a></li>
                    <li class="breadcrumb-item">Forward Pay</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
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
                          <th>Client Name</th>
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
                        @foreach ($forwardPayRecords as $forwardPayRecord)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $forwardPayRecord->client->name }}</td>
                            <td>{{ date('F', strtotime($forwardPayRecord->disbursement_date)) }}</td>
                            <td>{{ number_format($forwardPayRecord->fp_amount) }}</td>
                            <td>{{ $forwardPayRecord->admin_who_disburse }}</td>
                            <td>{{ date('d, M Y', strtotime($forwardPayRecord->disbursement_date)) }}</td>
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