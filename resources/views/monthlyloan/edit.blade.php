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
                    <li class="breadcrumb-item">Edit Loan</li>
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
            <a href="{{ route('viewclient', ['id' => $monthlyloan->client->id, 'branchID' => $branchID, 'viewType' => $viewType]) }}" data-bs-toggle="tooltip" title="View Client Details">
              <h5>Edit <span class="text-warning">{{ $monthlyloan->client->name }}'s</span> Loan Request</h5>
            </a>
          </div>
          <div class="card-body">
            @include('includes.alerts')
            <form class="f1" method="post" action="{{ route('updatemonthlyloan', ['id' => $monthlyloan->id, 'branchID' => $branchID, 'viewType' => $viewType]) }}">
              @csrf
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Fullname</label>
                      <select class="form-control" name="client_id">
                            <option value="{{ $monthlyloan->id }}">{{ $monthlyloan->client->name }}</option>
                            {{-- @foreach ($clients as $client )
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach --}}
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="amount">Loan Amount</label>
                      <div class="input-group input-group-air"><span class="input-group-text">&#8358;</span>
                        <input class="form-control" type="number" placeholder="50000" name="loan_amount" value="{{ $monthlyloan->loan_amount }}" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Duration">Loan Duration(Days)</label>
                        <input class="form-control" type="number" placeholder="50000" name="duration_in_days" value="{{ $monthlyloan->duration_in_days }}" required="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="Duration">Interest Rate</label>
                      <select class="form-control" id="duration" name="interest_percent" required>
                        <option value="{{ $monthlyloan->intrest_percent }}">{{ $monthlyloan->interest_percent }}%</option>
                        <option value="4" {{ old('interest_percent') == '4' ? 'selected' : '' }}>4%</option>
                        <option value="8" {{ old('interest_percent') == '8' ? 'selected' : '' }}>8%</option>
                        <option value="9" {{ old('interest_percent') == '9' ? 'selected' : '' }}>9%</option>
                        <option value="10" {{ old('interest_percent') == '10' ? 'selected' : '' }}>10%</option>
                      </select>
                        <input type="text" name="branch_id" value="{{$branchID}}">
                        <input type="text" name="viewType" value="{{$viewType}}">
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
