@extends('layouts.main') 
@section('title','All Debtors') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Clients in Tenure <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total clients in tenure</span></h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">All Debitors</li>
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
                        <span>Here is the details of all clients that are in tenure,</span><br><span>Note that clients in tenure cannot be given loan unti the end of a tenure.</span>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts')
                <div class="table-responsive">
                    <table class="display" id="basic-2">
                      <thead>
                        <tr>
                            <th>Client ID #</th>
                            <th>Client Name</th>
                            <th>Loan Amount (#)</th>
                            <th>Monthly Pay</th>
                            <th>Duration</th>
                            <th>Next Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($loans as $loan )
                        <tr>
                            <td>{{ $loan->client->client_no }}</td>
                            <td>{{ $loan->client->name }}</td>
                            <td>{{ number_format($loan->loan_amount) }}</td>
                            <td>{{ number_format($loan->monthly_payback) }}</td>
                            <td>
                                {{ date('M Y', strtotime($loan->disbursement_date)) }} - {{ date('M Y', strtotime($loan->loan_duration)) }}
                            </td>
                            <td>
                                @foreach ($loan->payment as $payment)
                                @if ($payment->payment_status == 0 )
                                {{ date('d,M Y', strtotime($payment->next_due_date)) }}
                                @endif
                                @endforeach 
                            </td>
                            <td>
                                @if ($loan->status == 3)
                                    <div class="span badge rounded-pill pill-badge-info pull-right">Tenure Extended</div>
                                @endif
                                @if ($loan->status == 2)
                                    <div class="span badge rounded-pill pill-badge-secondary pull-right">Payment Completed</div>
                                @endif
                                @if ($loan->status == 1)
                                    <div class="span badge rounded-pill pill-badge-success pull-right">In Tenure</div>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('makepayment', $loan->id) }}">
                                        <button class="btn btn-light text-warning" type="submit" data-bs-toggle="tooltip" title="View Full Details"> 
                                            <i class="fas fa-eye text-warning"></i>
                                        </button>
                                    </form> 
                                    @if (!is_null($loan->payment) && $loan->payment->sum('amount_paid') < $loan->total_payback)
                                        <form action="{{ route('makepayment', $loan->id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form> 
                                    @endif
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