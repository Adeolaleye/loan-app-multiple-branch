@extends('layouts.main') 
@section('title','Payout') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Payout History</h3>
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
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#makepayment" data-bs-toggle="tooltip">Make Random Payment</button>
                        </div>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="basic-2">
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
                        <tr>
                            <td>1</td>
                            <td>Olaleye Adeola</td>
                            <td>August</td>
                            <td>50,000</td>
                            <td>Loan</td>
                            <td>Davide Ogeh</td>
                            <td>20/11/2021</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Olaleye Adeola</td>
                            <td>August</td>
                            <td>50,000</td>
                            <td>Loan</td>
                            <td>Davide Ogeh</td>
                            <td>20/11/2021</td>
                        </tr>
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
