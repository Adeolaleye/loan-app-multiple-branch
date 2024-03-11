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
                        <div class="col-xl-12 col-sm-6 p-0 left_side_earning">
                            <div class="media p-0">
                                <div class="media-left"><i class="icon-bg" data-feather="database"></i></div>
                                <div class="media-body">
                                    <h6>Total Earnings</h6>
                                    <p>&#x20A6;{{number_format($allprofits)}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-6  p-0 left_side_earning">
                            <div class="media p-0">
                            <div class="media-left bg-secondary"><i class="icon-bg" data-feather="layers"></i></div>
                                <div class="media-body">
                                    <h6>Total Recievable</h6>
                                    <p>&#x20A6;{{number_format($companyvalue)}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-6 p-0 left_side_earning">
                            <div class="media p-0">
                                <div class="media-left"><i data-feather="users"></i></div>
                                <div class="media-body">
                                    <h6>All Clients</h6>
                                    <p>{{$allclients_count}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-sm-6  p-0 left_side_earning">
                            <div class="media p-0">
                            <div class="media-left bg-secondary"><i data-feather="users"></i></div>
                                <div class="media-body">
                                    <h6>Clients In Tenure</h6>
                                    <p>{{$clientintenure_count}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-9 p-0">
                        <div class="chart-right">
                        <div class="row m-0 p-tb">
                            <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                                <div class="inner-top-left">
                                    <h5>Daily Reports</h5>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                                <div class="inner-top-right">
                                    <ul class="d-flex list-unstyled justify-content-end">
                                    @if (!$dailyreports->isEmpty())
                                        <li><a href="{{ route('daily',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">View All</a></li>
                                    @endif
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
                        <!-- here -->
                            @if (!$dailyreports->isEmpty())
                            <div class="user-status table-responsive">
                                <table class="table table-bordernone">
                                    <thead>
                                    <tr>
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
                                            <td>{{ $dailyreport->client->name }}</td>
                                            <td>{{ number_format($dailyreport->outstanding_payment) }}</td>
                                            <td>{{ number_format($dailyreport->expect_pay) }}</td>
                                            <td>{{ date('d,M Y', strtotime($dailyreport->next_due_date)) }}</td>
                                            <td>
                                                <form action="{{ route('makemonthlypayment', $dailyreport->monthly_loan_id) }}">
                                                    <input type="hidden" name="branchID" value="{{$branchID}}">
                                                    <input type="hidden" name="viewType" value="{{$viewType}}">
                                                    <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h6 class="text-center">No record for today</h6>
                            @endif
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
                    <div class="row m-0 p-tb">
                        <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                            <div class="inner-top-left">
                                <h5>Defaulters in past days</h5>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                            <div class="inner-top-right">
                                <ul class="d-flex list-unstyled justify-content-end">
                                @if (!$defaulters->isEmpty())
                                    <li><a href="{{ route('dailydefaulter',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">View All</a></li>
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (!$defaulters->isEmpty())
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
                                        @foreach ($defaulter->monthlypayment as $payment)
                                        @if ($payment->payment_status == 0 )
                                    <td>
                                        {{ number_format($payment->outstanding_payment) }}
                                    </td>
                                    <td>{{ number_format($payment->expect_pay) }}</td>
                                    <td>{{ date('d,M Y', strtotime($payment->next_due_date)) }}</td>
                                        @endif
                                        @endforeach 
                                    
                                    <td>{{ $defaulter->duration_in_days}}</td>
                                    <td>
                                    @if ($defaulter->client->status == 'in tenure')
                                    <div class="span badge rounded-pill pill-badge-success pull-right">In Tenure</div>
                                    @else
                                    <div class="span badge rounded-pill pill-badge-dark pull-right">Unknown</div>
                                    @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('makemonthlypayment', $defaulter->id) }}">
                                                <input type="hidden" name="branchID" value="{{$branchID}}">
                                                <input type="hidden" name="viewType" value="{{$viewType}}">
                                                <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h6 class="text-center">No record found</h6>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-6 xl-100 box-col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row m-0 p-tb">
                        <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                            <div class="inner-top-left">
                                <h5>Tenure Extended Clients</h5>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                            <div class="inner-top-right">
                                <ul class="d-flex list-unstyled justify-content-end">
                                @if(!$tenureextendeds->isEmpty())
                                    <li><a href="{{ route('dailytenureextended',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">View All</a></li>
                                @endif
                                </ul>
                            </div>
                        </div>
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
                                        @foreach ($tenureextended->monthlypayment as $payment)
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
                                        <form action="{{ route('makemonthlypayment', $tenureextended->id) }}">
                                                <input type="hidden" name="branchID" value="{{$branchID}}">
                                                <input type="hidden" name="viewType" value="{{$viewType}}">
                                                <button class="btn btn-light text-secondary" type="submit">Pay Now</button>
                                        </form> 
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
<!-- Container-fluid Ends-->
@endsection
