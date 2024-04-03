@extends('layouts.main') 
@section('title','View Details') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>{{ $client->name }} Details <br> <span class="f-14 font-bold text-success"> # {{ $client->client_no }}</span></h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('clients') }}">All Clients</a>
                    </li>
                    <li class="breadcrumb-item">View Client</li>
                </ol>
                <a href="{{ route('printclient',$client->id) }}" class="pull-right m-t-10">
                    <button class="btn btn-secondary" type="submit">Print Client Details</button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="user-profile">
      <div class="row">
        <!-- user profile first-style start-->
        <div class="col-sm-12">
          <div class="card hovercard text-center">
            <div class="cardheader"></div>
            <div class="user-image">
                <div class="avatar">
                    @if($client->profile_picture)
                        <img src="{{ "/".$client->profile_picture }}" class="b-r-half">
                    @else 
                        <img src="/profile_pictures/avater.png"> 
                    @endif
                </div>
                @if ($viewType == 'BusinessOffice')
                    <div class="icon-wrapper" data-bs-toggle="tooltip" title="Edit Client">
                        <a href="{{ route('edit-daily-client', ['id' => $client->id, 'branchID' => $branchID, 'viewType' => $viewType]) }}"><i class="fas fa-edit text-mute"></i></a>  
                    </div>
                @else
                    <div class="icon-wrapper" data-bs-toggle="tooltip" title="Edit Client">
                        <a href="{{ route('editclient',$client->id) }}"><i class="fas fa-edit text-mute"></i></a>  
                    </div>
                @endif
            </div>
            <div class="info">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                    <div class="row">
                        @if ($viewType != 'BusinessOffice')
                        <div class="col-md-6">
                            <div class="ttl-info text-start text-center">
                                <h6>DOB</h6><span>{{ $client->dob }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ttl-info text-start text-center">
                                <h6>Marital Status</h6><span>{{ $client->marital_status }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                    <div class="user-designation">
                        <div class="title"><a target="_blank" href="#">{{ $client->name }}</a></div>
                        <div class="desc">{{ $client->phone }}</div><br>
                        @if ($viewType == 'BusinessOffice')
                            <h6> Occupation</h6><span>{{ $client->occupation }}</span>
                        @endif
                        <br>
                        <a href="#loanhistory" data-bs-toggle="tooltip" title="Click to view loan history">
                                    @if ($client->status == 'in review')
                                    <div class="span badge rounded-pill pill-badge-warning">In Review
                                    </div>
                                    @endif
                                    @if ($client->status == 'in tenure')
                                    <div class="span badge rounded-pill pill-badge-success">In Tenure</div>
                                    @endif
                                    @if ($client->status == 'out of tenure')
                                    <div class="span badge rounded-pill pill-badge-secondary">Out Of Tenure</div>
                                    @endif
                                    @if ($client->status == 'tenure extended')
                                    <div class="span badge rounded-pill pill-badge-info">Tenure Extended</div>
                                    @endif
                        </a>
                        {{-- <div class="span badge rounded-pill pill-badge-secondary">Out Of Tenure</div> --}}
                    </div>
                    </div>
                    @if ($viewType != 'BusinessOffice')
                    <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="ttl-info text-start text-center">
                                <h6> Gender</h6><span>{{ $client->gender }}</span>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="ttl-info text-start text-center">
                                <h6> Occupation</h6><span>{{ $client->occupation }}</span>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @if ($viewType != 'BusinessOffice')
                <hr>
                <div class="row">
                    <div class="col-6 col-lg-3 order-sm-1 order-xl-2">
                        <div class="ttl-info text-start text-center">
                            <h6>Residence</h6><span>{{ $client->residential_address }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-3 order-xl-1">
                        <div class="ttl-info text-start text-center">
                            <h6>Office Address</h6><span>{{ $client->office_address }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-0 order-xl-0">
                        <div class="ttl-info text-start text-center">
                            <h6>Means Of ID</h6><span>{{ $client->means_of_id }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-2 order-xl-3">
                        <div class="ttl-info text-start text-center">
                            <h6>Qualification</h6><span>{{ $client->qualification }}</span>
                        </div>
                    </div>
                </div>
                @endif
                <hr>
                    <h4>Guarantor Details</h4>
                <div class="row">
                    <div class="col-6 col-lg-3 order-sm-0 order-xl-0">
                        <div class="ttl-info text-start text-center">
                            <h6>Name</h6><span>{{ $client->g_name }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-2 order-xl-2">
                        <div class="ttl-info text-start text-center">
                            <h6>Mobile No</h6><span>{{ $client->g_phone }}</span>
                        </div>
                    </div>
                    @if ($viewType != 'BusinessOffice')
                    <div class="col-6 col-lg-3 order-sm-1 order-xl-1">
                        <div class="ttl-info text-start text-center">
                            <h6>Residential Address</h6><span>{{ $client->g_address }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-3 order-xl-3">
                        <div class="ttl-info text-start text-center">
                            <h6>Relationship</h6><span>{{ $client->g_relationship }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
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
                <div class="row" id="loanhistory">
                    <div class="col-md-8 col-sm-12">
                        <h5>Loan Time History</h5>
                        <span>Here is the details of loan time history of this client, at the click of eye button, you get to see the payment history of each loan time.</span>
                    </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                      <thead>
                        <tr>
                          <th>Loan Amount(#)</th>
                          <th>Date of Disbursement</th>
                          @if ($viewType == 'BusinessOffice')
                          <th>Duration in Days</th>
                          @else
                          <th>Tenure</th>
                          @endif
                          <th>Duration of payment</th>
                          <th>Interest(#)</th>
                          <th>Total Amount Paid(#)</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      @if ($viewType == 'BusinessOffice')
                      <tbody>
                        @foreach ( $client->monthlyloan->sortByDesc('updated_at') as $loan )
                        <tr>
                            <td>{{ number_format($loan->loan_amount) }}</td>
                            <td>{{ !is_null($loan->disbursement_date) ? date('d,M Y', strtotime($loan->disbursement_date)) : 'N/A' }}</td>
                            <td>{{ $loan->duration_in_days }}</td>
                            <td>{{ $loan->pay_back_days }}</td>
                            <td>{{ number_format($loan->interest) }}<br>
                                <span class="font-success f-12">{{$loan->interest_percent}}%</span></td>
                            <td>{{ number_format($loan->sum_of_allpayback) }}</td>
                            <td>
                                @if ($loan->status == 0)
                                <div class="span badge rounded-pill pill-badge-warning">In Review
                                </div>
                                @endif
                                @if ($loan->status == 1)
                                <div class="span badge rounded-pill pill-badge-success">In Tenure</div>
                                @endif
                                @if ($loan->status == 2)
                                <div class="span badge rounded-pill pill-badge-secondary">Out Of Tenure</div>
                                @endif
                                @if ($loan->status == 3)
                                <div class="span badge rounded-pill pill-badge-info">Tenure Extended</div>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('monthlyclientpayhistory',['id' => $loan->id, 'branchID' => $branchID, 'viewType' => $viewType]) }}" data-bs-toggle="tooltip" title="View Payment History">
                                        <span>View Pay History</span>
                                    </a>
                                    @if ($loan->status == 3 || $loan->status == 1)
                                        <form action="{{ route('makemonthlypayment', $loan->id) }}">
                                            <input type="hidden" name="branchID" value="{{$branchID}}">
                                            <input type="hidden" name="viewType" value="{{$viewType}}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form> 
                                    @endif
                                    @if ($loan->status == 0 || $loan->status == 2)
                                        <form action="{{ route('makemonthlypayment', $loan->id) }}">
                                            <input type="hidden" name="branchID" value="{{$branchID}}">
                                            <input type="hidden" name="viewType" value="{{$viewType}}">
                                            <button class="btn btn-light text-secondary" type="submit">View More</button>
                                        </form> 
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                      @elseif (is_null($viewType))
                      <tbody>
                        @foreach ( $client->loan->sortByDesc('updated_at') as $loan )
                        <tr>
                            <td>{{ number_format($loan->loan_amount) }}</td>
                            <td>{{ !is_null($loan->disbursement_date) ? date('d,M Y', strtotime($loan->disbursement_date)) : 'N/A' }}</td>
                            <td>{{ $loan->tenure }}</td>
                            <td>{{ $loan->loan_duration }}</td>
                            <td>{{ number_format($loan->intrest) }}<br>
                                <span class="font-success f-12">{{$loan->intrest_percent}}% per month</span></td>
                            <td>{{ number_format($loan->sum_of_allpayback) }}</td>
                            <td>
                                @if ($loan->status == 0)
                                <div class="span badge rounded-pill pill-badge-warning">In Review
                                </div>
                                @endif
                                @if ($loan->status == 1)
                                <div class="span badge rounded-pill pill-badge-success">In Tenure</div>
                                @endif
                                @if ($loan->status == 2)
                                <div class="span badge rounded-pill pill-badge-secondary">Out Of Tenure</div>
                                @endif
                                @if ($loan->status == 3)
                                <div class="span badge rounded-pill pill-badge-info">Tenure Extended</div>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('clientpayhistory',$loan->id) }}" data-bs-toggle="tooltip" title="View Payment History">
                                        <span>View Pay History</span>
                                    </a>
                                    @if ($loan->status == 3 || $loan->status == 1)
                                        <form action="{{ route('makepayment', $loan->id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form> 
                                    @endif
                                    @if ($loan->status == 0 || $loan->status == 2)
                                        <form action="{{ route('makepayment', $loan->id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">View More</button>
                                        </form> 
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                      @endif
                    </table>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>
@endsection