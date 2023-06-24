@extends('layouts.main') 
@section('title','Loan') 
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
                    <li class="breadcrumb-item">Request Loan</li>
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
            <h5>Request Loan</h5>
          </div>
          <div class="card-body">
            @include('includes.alerts')
            <form class="f1" method="post" action="{{ route('createloan') }}">
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
                        <label class="form-label" for="Duration">Loan Duration</label>
                        <select class="form-control" id="duration" name="tenure">
                          <option value="">--Choose Option--</option>
                          <option value="1"{{ old('tenure') == '1' ? 'selected' : '' }}>1 month</option>
                          <option value="2"{{ old('tenure') == '2' ? 'selected' : '' }}>2 months</option>
                          <option value="3"{{ old('tenure') == '3' ? 'selected' : '' }}>3 months</option>
                          <option value="4"{{ old('tenure') == '4' ? 'selected' : '' }}>4 months</option>
                          <option value="5"{{ old('tenure') == '5' ? 'selected' : '' }}>5 months</option>
                          <option value="6"{{ old('tenure') == '6' ? 'selected' : '' }}>6 months</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="Duration">Interest Rate</label>
                      <select class="form-control" id="duration" name="intrest_percent" required>
                        <option value="">--Choose Option--</option>
                        <option value="4" {{ old('intrest_percent') == '4' ? 'selected' : '' }}>4%</option>
                        <option value="4.5" {{ old('intrest_percent') == '4.5' ? 'selected' : '' }}>4.5%</option>
                        <option value="5" {{ old('intrest_percent') == '5' ? 'selected' : '' }}>5%</option>
                        <option value="5.5" {{ old('intrest_percent') == '5.5' ? 'selected' : '' }}>5.5%</option>
                        <option value="6" {{ old('intrest_percent') == '6' ? 'selected' : '' }}>6%</option>
                        <option value="6.5" {{ old('intrest_percent') == '6.5' ? 'selected' : '' }}>6.5%</option>
                        <option value="7" {{ old('intrest_percent') == '7' ? 'selected' : '' }}>7%</option>
                        <option value="7.5" {{ old('intrest_percent') == '7.5' ? 'selected' : '' }}>7.5%</option>
                        <option value="8" {{ old('intrest_percent') == '8' ? 'selected' : '' }}>8%</option>
                        <option value="9" {{ old('intrest_percent') == '9' ? 'selected' : '' }}>9%</option>
                        <option value="10" {{ old('intrest_percent') == '10' ? 'selected' : '' }}>10%</option>
                      </select>
                    </div>
                    <div class="col-md-6"> 
                      <label class="form-label" for="Duration">Forward Payment (%)</label>
                      <input type="text" class="form-control" placeholder="" name="forward_payment" value="5.99" min="1">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="Duration">Form Amount (&#8358;)</label>
                      <input type="text" class="form-control" placeholder="" name="formpayment" value="1000" min="1">
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
