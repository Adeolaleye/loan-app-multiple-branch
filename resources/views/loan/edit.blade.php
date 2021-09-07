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
            <h5>Edit <span class="text-warning">{{ $loan->client->name }}'s</span> Loan Request</h5>
          </div>
          <div class="card-body">
            @include('includes.alerts')
            <form class="f1" method="post" action="{{ route('updateloan', $loan->id) }}">
              @csrf
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Fullname</label>
                      <select class="form-control" name="client_id">
                            <option value="{{ $loan->id }}">{{ $loan->client->name }}</option>
                            {{-- @foreach ($clients as $client )
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach --}}
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="amount">Loan Amount</label>
                      <div class="input-group input-group-air"><span class="input-group-text">#</span>
                        <input class="form-control" type="number" placeholder="50000" name="loan_amount" value="{{ $loan->loan_amount }}" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="Duration">Loan Duration</label>
                        <select class="form-control" id="duration" name="tenure">
                          <option value="{{ $loan->tenure }}">{{ $loan->tenure }} months</option>
                          <option value="1">1 month</option>
                          <option value="2">2 months</option>
                          <option value="3">3 months</option>
                          <option value="4">4 months</option>
                          <option value="5">5 months</option>
                          <option value="6">6 months</option>
                        </select>
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
