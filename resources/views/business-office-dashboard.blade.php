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
        <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
            <div class="card earning-card">
                <div class="card-body p-0">
                    <div class="row m-0">
                    <div class="col-xl-3 earning-content p-0">
                        <div class="row m-0 chart-left">
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>Dashboard</h5>
                            <p class="font-roboto">Overview of last month</p>
                        </div>
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>$4055.56 </h5>
                            <p class="font-roboto">This Month Earning</p>
                        </div>
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>$1004.11</h5>
                            <p class="font-roboto">This Month Profit</p>
                        </div>
                        <div class="col-xl-12 p-0 left_side_earning">
                            <h5>90%</h5>
                            <p class="font-roboto">This Month Sale</p>
                        </div>
                        <div class="col-xl-12 p-0 left-btn"><a class="btn btn-gradient">Summary</a></div>
                        </div>
                    </div>
                    <div class="col-xl-9 p-0">
                        <div class="chart-right">
                        <div class="row m-0 p-tb">
                            <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                            <div class="inner-top-left">
                                <ul class="d-flex list-unstyled">
                                <li>Daily</li>
                                <li class="active">Weekly</li>
                                <li>Monthly</li>
                                <li>Yearly</li>
                                </ul>
                            </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                            <div class="inner-top-right">
                                <ul class="d-flex list-unstyled justify-content-end">
                                <li>Online</li>
                                <li>Store</li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                            <div class="card-body p-0">
                                <div class="current-sale-container">
                                <div id="chart-currently"></div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="row border-top m-0">
                        <div class="col-xl-4 ps-0 col-md-6 col-sm-6">
                            <div class="media p-0">
                            <div class="media-left"><i class="icofont icofont-crown"></i></div>
                            <div class="media-body">
                                <h6>Referral Earning</h6>
                                <p>$5,000.20</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-sm-6">
                            <div class="media p-0">
                            <div class="media-left bg-secondary"><i class="icofont icofont-heart-alt"></i></div>
                            <div class="media-body">
                                <h6>Cash Balance</h6>
                                <p>$2,657.21</p>
                            </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-12 pe-0">
                            <div class="media p-0">
                            <div class="media-left"><i class="icofont icofont-cur-dollar"></i></div>
                            <div class="media-body">
                                <h6>Sales forcasting</h6>
                                <p>$9,478.50     </p>
                            </div>
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
        <div class="col-xl-6 xl-100 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daily Report</h5>
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
                                @foreach ($dailyreports as $dailyreport)
                                <tr>
                                    <td>{{ $dailyreport->client->client_no }}</td>
                                    <td>{{ $dailyreport->client->name }}</td>
                                    <td>{{ number_format($dailyreport->outstanding_payment) }}</td>
                                    <td>{{ number_format($dailyreport->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($dailyreport->next_due_date)) }}</td>
                                    <td>
                                        <form action="{{ route('makepayment', $dailyreport->loan_id) }}">
                                            <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    {{-- <a href="{{ route('monthly') }}">View All</a>--}}
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
                            
                        </table>
                    </div>
                    <hr>
                    {{--<a href="{{ route('tenureextended') }}">View All</a>--}}
                </div>
            </div>
        </div>
        <div class="col-xl-6 xl-100 box-col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Defaulters in past days</h5>
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
                            
                        </table>
                    </div>
                    <hr>
                    {{--<a href="{{ route('defaulter') }}">View All</a>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
