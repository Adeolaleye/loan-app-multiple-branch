@extends('layouts.main') 
@section('title','Payment') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Pay in History</h3>
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
                <div class="table-responsive">
                    <table class="display" id="basic-2">
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
                        <tr>
                            <td>1</td>
                            <td>Olaleye Adeola</td>
                            <td>August</td>
                            <td>20,000</td>
                            <td>Payback</td>
                            <td>Davide Ogeh</td>
                            <td>20/11/2021</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Olaleye Adeola</td>
                            <td>August</td>
                            <td>20,000</td>
                            <td>Payback</td>
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
@include('payment.popup')
@endsection
