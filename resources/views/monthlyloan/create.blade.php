@extends('layouts.main') 
@section('title','Monthly Loan') 
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
                    <li class="breadcrumb-item"><a href="{{ route('loan') }}">Loan History</a></li>
                    <li class="breadcrumb-item">Request Monthly Loan</li>
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
            {{dump($branchID)}}
            <h5>Request Monthly Loan</h5>
          </div>
          <div class="card-body">
            @include('includes.alerts')
            <form class="f1" method="post" action="{{ route('createmonthlyloan',['id' => $branchID, 'viewType' => $viewType]) }}">
              @csrf
                  <div class="row g-3 mb-2">
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Fullname</label>
                      <select class="form-control" name="client_id">
                            <option value="">--Choose Name--</option>
                            @foreach ($clients as $client )
                            <option value="{{ $client->id }}"{{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="amount">Loan Amount</label>
                      <div class="input-group input-group-air"><span class="input-group-text">&#8358;</span>
                        <input class="form-control" type="number" placeholder="50000" name="loan_amount" value="{{ old('loan_amount') }}" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Duration">Loan Duration (days)</label>
                        <input type="text" class="form-control" placeholder="" name="duration_in_days" value="20" min="1">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="Duration">Interest Rate</label>
                      <select class="form-control" id="duration" name="interest_percent" required>
                        <option value=""{{ old('interest_percent') ? '' : ' selected' }} disabled>Select Interest</option>
                        <option value="4" {{ old('interest_percent') == '4' ? 'selected' : '' }}>4%</option>
                        <option value="8" {{ old('interest_percent') == '8' ? 'selected' : '' }}>8%</option>
                        <option value="9" {{ old('interest_percent') == '9' ? 'selected' : '' }}>9%</option>
                        <option value="10" {{ old('interest_percent') == '10' ? 'selected' : '' }}>10%</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="Duration">Form Amount (&#8358;)</label>
                      <input type="text" class="form-control" placeholder="" name="form_payment" value="1000" min="1">
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                  </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
