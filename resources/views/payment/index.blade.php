@extends('layouts.main') 
@section('title','Payment') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Pay in History <br> <span class="f-14 font-bold text-warning"> {{ $counter }} total payments</span> </h3>
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
                            @if ($viewType == 'BusinessOffice')
                              <a href="{{ route('monthlyclientpayout',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}" data-bs-toggle="tooltip" title="Payout History">
                                  <button class="btn btn-secondary" type="button" title="View Full Details">View Payout</button>
                              </a>
                            @else
                              <a href="{{ route('payout') }}" data-bs-toggle="tooltip" title="Payout History">
                                  <button class="btn btn-secondary" type="button" title="View Full Details">View Payout</button>
                              </a>
                            @endif
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#savemoney" data-bs-toggle="tooltip">Save Money</button>
                        </div>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts')
                      <form class="f1" method="post" action="{{ route('filterpayment',['branchID' => $branchID, 'viewType' => $viewType])}}">
                        @csrf
                        <input type='hidden' name="branchID" value="{{$branchID}}">
                        <input type='hidden' name="viewType" value="{{$viewType}}">
                        <div class="row m-b-20">
                          <div class="col-md-5">
                            <label class="form-label" for="year">Years</label>
                            <select class="form-select" id="year" required="" name="year">
                                <option value="">--Select year--</option>
                              @foreach($years as $key => $value)
                                <option value="{{ $value }}" {{ old('year') == $value ? 'selected' : '' }} {{ isset($selected_year) && $selected_year == $value ? 'selected' : '' }}>{{ $key }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-5">
                            <label class="form-label" for="month">Months</label>
                            <select class="form-select" id="month" required="" name="month">
                                <option value="">--Select month--</option>
                              @foreach($months as $month=>$value)
                                <option value="{{ $value }}" {{ old('month') == $value ? 'selected' : '' }} {{ isset($selected_month) && $selected_month == $value ? 'selected' : '' }}>{{ $month }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-1">
                            <label class="form-label">Filter</label>
                            <button class="btn btn-primary" type="submit"><i class="fa fa-random" aria-hidden="true"></i>
                            </button>
                          </div>
                          <div class="col-md-1">
                            <label class="form-label">Reset</label>
                            @if ($viewType == 'BusinessOffice')
                              <a href="{{ route('monthlypayin',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}" class="btn btn-danger"><i class="fa fa-undo" ></i></a>
                            @else
                              <a href="{{ route('payment') }}" class="btn btn-danger"><i class="fa fa-undo" ></i></a>
                            @endif
                          </div>
                        </div>
                      </form>
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                      <thead>
                        <tr>
                             <!-- @if(Auth::user()->status == 1 )<th>l-id</th><th>p-id</th>@endif -->
                          <th>#</th>
                          <th>Made By</th>
                          @if ($viewType == 'BusinessOffice')
                          <th>Payment for Day</th>
                          @else
                          <th>Payment for Month</th>
                          @endif
                          <th>Amount</th>
                          <th>Profit</th>
                          <th>Purpose</th>
                          <th>Admin in Charge</th>
                          <th>Date Paid</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php 
                        $i = 1;
                        @endphp
                        @foreach ($payments as $payment)
                        <tr>
                            <!-- @if(Auth::user()->status == 1 )<td>{{ $payment->loan_id }}</td><td>{{ $payment->id }}</td>@endif -->
                            <td>{{ $i++ }}</td>
                            <td>
                                @if ($viewType == 'BusinessOffice')
                                  @if($payment->monthlyloan->purpose =='Monthly loan payback')
                                      {{ !is_null($payment->client->name) ? $payment->client->name : 'Not Available' }}
                                  @endif
                                  @if($payment->payment_purpose =='savings')
                                      By Admin in charge
                                  @endif
                                @else
                                  @if($payment->payment_purpose =='loan payback')
                                      {{ !is_null($payment->client->name) ? $payment->client->name : 'Not Available' }}
                                  @endif
                                  @if($payment->payment_purpose =='savings')
                                      By Admin in charge
                                  @endif
                                @endif
                            </td>
                            @if ($viewType == 'BusinessOffice')
                              <td>{{ date('jS F', strtotime($payment->next_due_date)) }}</td>
                            @else
                              <td>{{ date('M', strtotime($payment->next_due_date)) }}</td>
                            @endif
                            <td>{{ number_format($payment->amount_paid) }}</td>
                            <td>{{ number_format($payment->profit) }}</td>
                            @if ($viewType == 'BusinessOffice')
                            <td>{{ $payment->monthlyloan->purpose }}</td>
                            @else
                            <td>{{ $payment->payment_purpose }}</td>
                            @endif
                            <td>{{ $payment->admin_incharge }}</td>
                            <td>{{ date('d, M Y h:i A', strtotime($payment->date_paid)) }}</td>
                        </tr>
                        @endforeach
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