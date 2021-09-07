@extends('layouts.main') 
@section('title','Loan History') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h5>Monthly Report <br> <span class="f-14 font-bold text-warning">20 Clients to pay in September</span></h5>
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
                    <div class="col-md-4 col-sm-12">
                        <a href="{{ route('requestloan') }}">
                            <button class="btn btn-primary pull-right" type="button" data-bs-toggle="tooltip" title="Add new debitor">Request Loan</button>
                        </a>
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
                                <th>Outstanding (#)</th>
                                <th>Expected Pay(#)</th>
                                <th>Duration</th>
                                <th>Next Due Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>12345</td>
                                <td>Olaley Adeola</td>
                                <td>50,000</td>
                                <td>10000</td>
                                <td>Sept - Dec 2021</td>
                                <td>26/10/2021</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="">
                                            <button class="btn btn-light text-success" type="submit">Pay Now</button>
                                        </form>
                                    </div>
                                </td>
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
