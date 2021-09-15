@extends('layouts.main') 
@section('title','Edit {{ $client->name }} Details') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Edit {{ $client->name }} Details</h3>
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
            <form class="f1" method="post" action="{{ route('updateclient', $client->id) }}" enctype="multipart/form-data">
              @csrf
              <div class="f1-steps">
                <div class="f1-progress">
                  <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"></div>
                </div>
                <div class="f1-step active">
                  <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                  <p>Registration</p>
                </div>
                <div class="f1-step">
                  <div class="f1-step-icon"><i class="fa fa-file"></i></div>
                  <p>Other Self Details</p>
                </div>
                <div class="f1-step">
                  <div class="f1-step-icon"><i class="fa fa-users"></i></div>
                  <p>Guarantor Details</p>
                </div>
              </div>
              <fieldset>
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Fullname</label>
                      <input class="form-control" id="fullname" name="name" type="text" value="{{ $client->name }}" required="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="phone">Phone Number</label>
                      <input class="form-control" id="phone" type="text" name="phone" value="{{ $client->phone }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="dob">Date Of Birth</label>
                        <input class="form-control" id="dob" type="date" name="dob" value="{{ $client->dob }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="phone">Gender</label>
                        <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                            <div class="form-check form-check-inline radio radio-primary">
                              <input class="form-check-input" id="female" type="radio" name="gender" value="Female">
                              <label class="form-check-label mb-0" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline radio radio-primary">
                              <input class="form-check-input" id="male" type="radio" name="gender" value="Male">
                              <label class="form-check-label mb-0" for="male">Male</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="marital_status">Marital Status</label>
                        <div class="valid-feedback">Looks good!</div>
                        <select class="form-control" name="marital_status">
                            <option value="{{ $client->marital_status }}">{{ $client->marital_status }}</option>
                            <option value="Married">Married</option>
                            <option value="Single">Single</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="occupation">Occupation</label>
                        <input class="form-control" name="occupation" id="occupation" type="text" value="{{ $client->occupation }}" required="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="profile_picture">Profile Picture (Optional)</label>
                      <input class="form-control" type="file" value="{{ $client->profile_picture }}" name="profile_picture">
                    </div>
                </div>
                <div class="f1-buttons">
                  <button class="btn btn-primary btn-next" type="button">Next</button>
                </div>
              </fieldset>
              <fieldset>
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                      <label class="form-label" for="residential_address">Residential Address</label>
                      <input class="form-control" name="residential_address" id="residential_address" type="address" value="{{ $client->residential_address }}" required="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="office_address">Office Address</label>
                      <input class="form-control" name="office_address" id="office_address" type="address" value="{{ $client->office_address }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="identity">Means Of Identity</label>
                        <select class="form-control" name="means_of_id">
                            <option value="{{ $client->means_of_id }}">{{ $client->means_of_id }}</option>
                            <option value="National Identity Card">National Identity Card</option>
                            <option value="Voters Card">Voters Card</option> 
                            <option value="International ID Card">International ID Card</option>
                            <option value="Office ID Card">Office ID Card</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="qualification">Qualification</label>
                        <input class="form-control" name="qualification" id="qualification" type="text" value="{{ $client->qualification }}" required="">
                    </div>
                </div>
                <div class="f1-buttons">
                  <button class="btn btn-primary btn-previous" type="button">Previous</button>
                  <button class="btn btn-primary btn-next" type="button">Next</button>
                </div>
              </fieldset>
              <fieldset>
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                      <label class="form-label" for="guarantor_name">Guarantor's Name</label>
                      <input class="form-control" name="g_name" id="guarantor_name" type="text" value="{{ $client->g_name }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="guarantor_name">Guarantor's Phone</label>
                        <input class="form-control" name="g_phone" id="guarantor_phone" type="text" value="{{ $client->g_phone }}" required="">
                      </div>
                    <div class="col-md-6">
                      <label class="form-label" for="guarantor_address">Residential Address</label>
                      <input class="form-control" name="g_address" id="g_address" type="address" value="{{ $client->g_address }}" required="">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="qualification">Relationship</label>
                        <input class="form-control" name="g_relationship" id="relationship" type="text" value="{{ $client->g_relationship }}" required="">
                    </div>
                </div>
                <div class="f1-buttons">
                  <button class="btn btn-primary btn-previous" type="button">Previous</button>
                  <button class="btn btn-primary btn-submit" type="submit">Submit</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection