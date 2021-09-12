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
              <div class="icon-wrapper" data-bs-toggle="tooltip" title="Edit Client">
                <a href="{{ route('editclient', $client->id) }}"><i class="fas fa-edit text-mute"></i></a>  
                </div>
            </div>
            <div class="info">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                    <div class="row">
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
                    </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                    <div class="user-designation">
                        <div class="title"><a target="_blank" href="#">{{ $client->name }}</a></div>
                        <div class="desc">{{ $client->phone }}</div>
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
                </div>
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
                <hr>
                    <h4>Guarantor Details</h4>
                <div class="row">
                    <div class="col-6 col-lg-3 order-sm-0 order-xl-0">
                        <div class="ttl-info text-start text-center">
                            <h6>Name</h6><span>{{ $client->g_name }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-1 order-xl-1">
                        <div class="ttl-info text-start text-center">
                            <h6>Residential Address</h6><span>{{ $client->g_address }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-2 order-xl-2">
                        <div class="ttl-info text-start text-center">
                            <h6>Mobile No</h6><span>{{ $client->g_phone }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 order-sm-3 order-xl-3">
                        <div class="ttl-info text-start text-center">
                            <h6>Relationship</h6><span>{{ $client->g_relationship }}</span>
                        </div>
                    </div>
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
                    <table class="display" id="basic-2">
                      <thead>
                        <tr>
                          <th>Loan Amount(#)</th>
                          <th>Date of Disbursement</th>
                          <th>Tenure</th>
                          <th>Duration</th>
                          <th>Intrest(#)</th>
                          {{-- <th>Forward Payment (#)</th> --}}
                          <th>Total Amount Paid(#)</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $client->loan as $loan )
                        <tr>
                            <td>{{ number_format($loan->loan_amount) }}</td>
                            <td>{{ date('d,M Y', strtotime($loan->disbursement_date)) }}</td>
                            <td>{{ $loan->tenure }}</td>
                            <td>{{ date('M Y', strtotime($loan->disbursement_date)) }} - {{ date('M Y', strtotime($loan->loan_duration)) }}</td>
                            <td>{{ number_format($loan->intrest) }}<br>
                                <span class="font-success f-12">5% per month</span></td>
                            {{-- <td>
                                {{ $loan->fp_amount }}<br>
                                @if ($loan->fp_status == 'Not paid')
                                <span class="font-secondary f-12">{{ $loan->fp_status }}</span>
                                @endif
                                @if ($loan->fp_status == 'Paid')
                                <span class="font-success f-12">{{ $loan->fp_status }}</span>
                                @endif
                            </td> --}}
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
                                    @if (!is_null($loan->payment) && $loan->payment->sum('amount_paid') < $loan->total_payback)
                                        <form action="{{ route('makepayment', $loan->id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form> 
                                    @endif
                                    @if (!is_null($loan->payment) && $loan->payment->sum('amount_paid') == $loan->total_payback)
                                        <form action="{{ route('makepayment', $loan->id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">View More</button>
                                        </form> 
                                    @endif
                                </div>
                            </td>
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
@endsection
<!-- Modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="paymenthistory" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="paymenthistory">Payment History</h4>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
              <table class="display" id="basic-1">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Payment No</th>
                    <th>Balance Brought Forward</th>
                    <th>Amount Paid</th>
                    <th>Outstanding</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>26/10/2021</td>
                        <td>1</td>
                        <td>750</td>
                        <td>12,000</td>
                        <td>42,250</td>
                    </tr>
                    <tr>
                        <td>27/10/2021</td>
                        <td>2</td>
                        <td>750</td>
                        <td>12,000</td>
                        <td>42,250</td>
                    </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
