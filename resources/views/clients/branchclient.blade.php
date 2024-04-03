@extends('layouts.main') 
@section('title','Create Client') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home')  }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('clients') }}">All Clients</a></li>
                    <li class="breadcrumb-item">Add Client</li>
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
            <h5>Create Client Profile</h5>
          </div>
          <div class="card-body">
          @include('includes.alerts')
            <form method="post" action="{{ route('createdailyclient') }}">
              @csrf
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                      <label class="form-label" for="clientno">Client ID # <span class="text-danger">*</span> </label>
                      <input class="form-control" id="clientno" name="client_no" type="number" value="{{ old('client_no') }}" required="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Fullname <span class="text-danger">*</span></label>
                      <input class="form-control" id="fullname" name="name" type="text" value="{{ old('name') }}" required="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="phone">Phone Number <span class="text-danger">*</span></label>
                      <input class="form-control" id="phone" type="text" name="phone" value="{{ old('phone') }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="occupation">Occupation <span class="text-danger">*</span></label>
                        <input class="form-control" name="occupation" id="occupation" type="text" value="{{ old('occupation') }}" required="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="guarantor_name">Guarantor's Name <span class="text-danger">*</span></label>
                      <input class="form-control" name="g_name" id="guarantor_name" type="text" value="{{ old('g_name') }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="guarantor_name">Guarantor's Phone <span class="text-danger">*</span></label>
                        <input class="form-control" name="g_phone" id="guarantor_phone" type="number" value="{{ old('g_phone') }}" required="">
                        <input type="text" name="branch_id" value="{{$branchID}}">
                        <input type="text" name="viewType" value="{{$viewType}}">
                    </div>
                </div>
                <div class="f1-buttons">
                  <button class="btn btn-primary btn-submit" type="submit">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection