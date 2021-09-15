@extends('layouts.main') 
@section('title','All Debtors') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Clients in Tenure <br> <span class="f-14 font-bold text-warning"> total clients in tenure</span></h3>
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
            <h5 class="mb-3">In Tenure</span>
          </div>
          <div class="card-body">
            <div id="basicScenario"></div>
          </div>
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
                    </table>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection