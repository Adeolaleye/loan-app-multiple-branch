@extends('layouts.main') 
@section('title','Payment') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Form Payment History <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total payments</span> </h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('payment')  }}">Payment</a></li>
                    <li class="breadcrumb-item">Form Pay</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
              {{-- form payments --}}
              <div class="card-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h5>Here are form payments history</h5>
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
                        @foreach ($formPayRecords as $formPayRecord)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $formPayRecord->client->name }}</td>
                            <td>{{ date('F', strtotime($formPayRecord->disbursement_date)) }}</td>
                            @if ($viewType == 'BusinessOffice')
                            <td>{{ number_format($formPayRecord->form_payment) }}</td>
                            @else
                            <td>{{ number_format($formPayRecord->formpayment) }}</td>
                            @endif
                            <td>{{ $formPayRecord->admin_incharge }}</td>
                            <td>{{ date('d, M Y', strtotime($formPayRecord->created_at)) }}</td>
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