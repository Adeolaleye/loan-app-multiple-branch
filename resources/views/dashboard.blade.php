@extends('layouts.main') 
@section('title','Dashboard') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Overview</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body bg-secondary b-r-16">
                    <div class="tabbed-card">
                        <ul class="pull-right nav nav-tabs border-tab nav-primary" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="false">Overall</a></li>
                            <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true">Annual</a></li>
                            <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false">A Month</a></li>
                        </ul>
                        <div class="tab-content" id="pills-clrtabContent1">
                            <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">Earnings</span>
                                        <h4 class="mb-0">#{{ $allprofits }}</h4>
                                        <i class="icon-bg" data-feather="database"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">Earnings</span>
                                        <h4 class="mb-0">#2300</h4>
                                        <i class="icon-bg" data-feather="database"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">Earnings</span>
                                        <h4 class="mb-0">#1000</h4>
                                        <i class="icon-bg" data-feather="database"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="users"></i></div>
                        <div class="media-body">
                            <span class="m-0">All Clients</span>
                            <h4 class="mb-0 counter">{{ $allclients_count }}</h4>
                            <i class="icon-bg" data-feather="user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-warning b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="user"></i></div>
                        <div class="media-body">
                            <span class="m-0">Clients in Tenure</span>
                            <h4 class="mb-0 counter">{{ $clientintenure_count }}</h4>
                            <i class="icon-bg" data-feather="user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body bg-secondary b-r-16">
                    <div class="tabbed-card">
                        <ul class="nav nav-tabs border-tab nav-primary" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link" id="value_tab" data-bs-toggle="tab" href="#company_value" role="tab" aria-controls="company_value" aria-selected="true">Payable</a></li>
                            <li class="nav-item"><a class="nav-link active" id="savings-tab" data-bs-toggle="tab" href="#savings" role="tab" aria-controls="savings" aria-selected="false">Savings</a></li>
                        </ul>
                        <div class="tab-content" id="pills-clrtabContent2">
                            <div class="tab-pane fade" id="company_value" role="tabpanel" aria-labelledby="value_tab">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="layers"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">Company Value</span>
                                        <h4 class="mb-0">#{{ $companyvalue }}</h4>
                                        <i class="icon-bg" data-feather="layers"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="savings" role="tabpanel" aria-labelledby="savings-tab">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="layers"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">All Savings</span>
                                        <h4 class="mb-0">#{{ $allsavings }}</h4>
                                        <i class="icon-bg" data-feather="layers"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row second-chart-list third-news-update">
        <div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
            <div class="card gradient-primary o-hidden">
                <div class="card-body">
                    <div class="default-datepicker">
                        <div class="datepicker-here" data-language="en"></div>
                    </div>
                    <span class="default-dots-stay overview-dots full-width-dots">
                        <span class="dots-group">
                            <span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span>
                            <span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"> </span>
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 xl-50 box-col-12">
            <div class="card social-widget-card">
                <div class="card-body">
                  <div class="p-70">
                    <div class="redial-social-widget radial-bar-70" data-label="50%"><i class="fa fa-linkedin font-primary"></i></div>
                    <h5 class="b-b-light">Profit</h5>
                    <div class="row">
                        <div class="col text-center b-r-light">
                            <span>Existing</span>
                            <h4 class="counter mb-0">1234</h4>
                        </div>
                        <div class="col text-center">
                            <span>Concluded</span>
                            <h4 class="counter mb-0">4369</h4>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 xl-100 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Monthly Report <br> <span class="f-14 font-bold text-warning">20 Clients to pay in September</span></h5>
                    <div class="card-header-right">
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-status table-responsive">
                        <table class="table table-bordernone">
                            <thead>
                              <tr>
                                  <th>Client ID #</th>
                                  <th>Client Name</th>
                                  <th>Outstanding (#)</th>
                                  <th>Expected Pay(#)</th>
                                  <th>Duration</th>
                                  <th>Next Due Date</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlyreports as $monthlyreport)
                                <tr>
                                    <td>{{ $monthlyreport->client->client_no }}</td>
                                    <td>{{ $monthlyreport->client->name }}</td>
                                    <td>{{ $monthlyreport->outstanding_payment }}</td>
                                    <td>{{ $monthlyreport->expect_pay }}</td>
                                    <td>
                                        {{-- @foreach ($monthlyreport->loan as $loan )
                                        {{ date('M Y', strtotime($loan->disbursement_date)) }} - {{ date('M Y', strtotime($loan->loan_duration)) }}
                                        @endforeach
                                        {{ $monthlyreport->loan }} --}}
                                    </td>
                                    <td>{{ date('d,M Y', strtotime($monthlyreport->next_due_date)) }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#tenuredetails" data-bs-toggle="tooltip" title="View Full Details"><i class="fas fa-eye text-warning"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <a href="{{ route('monthly') }}">View All</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
