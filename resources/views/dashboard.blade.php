@extends('layouts.main') 
@section('title','Dashboard') 
@section('content')
<style>
    .tabbed-card ul {
    right: 46px;
}
@media only screen and (max-width: 767.98px){
.tabbed-card ul.border-tab.nav-tabs {
    right: 5px;
}
}
</style>
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
                @if(Auth::user()->role=='Super Admin' || Auth::user()->role=='Supervisor' )
                <div class="card-body bg-secondary b-r-16">
                    <div class="tabbed-card">
                            <ul class="pull-right nav nav-tabs border-tab nav-primary" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false">Monthly</a></li><li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true">Annual</a></li>
                                <li class="nav-item"><a class="nav-link" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="false">Overall</a></li>   
                            </ul>
                            <div class="tab-content" id="pills-clrtabContent1">
                                
                                <div class="tab-pane fade show active" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                        <div class="media-body">
                                            <span class="m-0">Earnings</span>
                                            <h4 class="mb-0">&#x20A6;{{ number_format($monthlyprofit) }}</h4>
                                            <i class="icon-bg" data-feather="database"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                        <div class="media-body">
                                            <span class="m-0">Earnings</span>
                                            <h4 class="mb-0">&#x20A6;{{ number_format($yearlyprofit) }}</h4>
                                            <i class="icon-bg" data-feather="database"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                        <div class="media-body">
                                            <span class="m-0">Earnings</span>
                                            <h4 class="mb-0">&#x20A6;{{ number_format($allprofits) }}</h4>
                                            <i class="icon-bg" data-feather="database"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                @endif
                @if(Auth::user()->role=='Branch Manager' || Auth::user()->role=='Officer' )
                <div class="bg-secondary b-r-16 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                        <div class="media-body">
                            <span class="m-0">Extended Tenure</span>
                            <h4 class="mb-0 counter">{{ $clienttenurextended_count }}</h4>
                            <i class="icon-bg" data-feather="database"></i>
                        </div>
                    </div>
                </div>
                @endif
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
                            <span class="m-0">All Clients in Tenure</span>
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
                            @if(Auth::user()->role=='Super Admin' )
                            <li class="nav-item"><a class="nav-link" id="value_tab" data-bs-toggle="tab" href="#company_value" role="tab" aria-controls="company_value" aria-selected="true">Payable</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link active" id="savings-tab" data-bs-toggle="tab" href="#savings" role="tab" aria-controls="savings" aria-selected="false">Savings</a></li>
                        </ul>
                        <div class="tab-content" id="pills-clrtabContent2">
                            <div class="tab-pane fade" id="company_value" role="tabpanel" aria-labelledby="value_tab">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="layers"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">Company Value</span>
                                        <h4 class="mb-0">&#x20A6;{{ number_format($companyvalue) }}</h4>
                                        <i class="icon-bg" data-feather="layers"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="savings" role="tabpanel" aria-labelledby="savings-tab">
                                <div class="media static-top-widget">
                                    <div class="align-self-center text-center"><i data-feather="layers"></i></div>
                                    <div class="media-body">
                                        <span class="m-0">All Savings</span>
                                        <h4 class="mb-0">&#x20A6;{{ number_format($allsavings) }}</h4>
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
                    <h5>Monthly Report</h5>
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
                                  <th>Outstanding (&#x20A6;)</th>
                                  <th>Expected Pay(&#x20A6;)</th>
                                  <th>Next Due Date</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlyreports as $monthlyreport)
                                <tr>
                                    <td>{{ $monthlyreport->client->client_no }}</td>
                                    <td>{{ $monthlyreport->client->name }}</td>
                                    <td>{{ number_format($monthlyreport->outstanding_payment) }}</td>
                                    <td>{{ number_format($monthlyreport->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($monthlyreport->next_due_date)) }}</td>
                                    <td>
                                        <form action="{{ route('makepayment', $monthlyreport->loan_id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form>
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
        <div class="col-xl-6 xl-100 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tenure Extended Clients</h5>
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
                                  <th>Outstanding (&#x20A6;)</th>
                                  <th>Expected Pay(&#x20A6;)</th>
                                  <th>Next Due Date</th>
                                  <th>Duration</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenureextendeds as $tenureextended)
                                <tr>
                                    <td>{{ $tenureextended->client->client_no }}</td>
                                    <td>{{ $tenureextended->client->name }}</td>
                                        @foreach ($tenureextended->payment as $payment)
                                        @if ($payment->payment_status == 0 )
                                    <td>
                                        {{ number_format($payment->outstanding_payment) }}
                                    </td>
                                    <td>{{ number_format($payment->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($payment->next_due_date)) }}</td>
                                        @endif
                                        @endforeach 
                                    
                                    <td>{{ $tenureextended->loan_duration }}</td>
                                    {{-- <td>{{ date('d,M Y', strtotime($tenureextended->next_due_date)) }}</td> --}}
                                    <td>
                                        <form action="{{ route('makepayment', $tenureextended->id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <a href="{{ route('tenureextended') }}">View All</a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 xl-100 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Defaulters in past months</h5>
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
                                  <th>Outstanding (&#x20A6;)</th>
                                  <th>Expected Pay(&#x20A6;)</th>
                                  <th>Next Due Date</th>
                                  <th>Duration</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($defaulters as $defaulter)
                                <tr>
                                    <td>{{ $defaulter->client->client_no }}</td>
                                    <td>{{ $defaulter->client->name }}</td>
                                        @foreach ($defaulter->payment as $payment)
                                        @if ($payment->payment_status == 0 )
                                    <td>
                                        {{ number_format($payment->outstanding_payment) }}
                                    </td>
                                    <td>{{ number_format($payment->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($payment->next_due_date)) }}</td>
                                        @endif
                                        @endforeach 
                                    
                                    <td>{{ $defaulter->loan_duration }}</td>
                                    <td>
                                    @if ($defaulter->client->status == 'in tenure')
                                    <div class="span badge rounded-pill pill-badge-success pull-right">In Tenure</div>
                                    @else
                                    <div class="span badge rounded-pill pill-badge-dark pull-right">Unknown</div>
                                    @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('makepayment', $defaulter->id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <a href="{{ route('defaulter') }}">View All</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
