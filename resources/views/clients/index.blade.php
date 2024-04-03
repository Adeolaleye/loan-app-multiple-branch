@extends('layouts.main') 
@section('title','All Clients') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Registered Clients in 
                    @if (isset($viewType) &&  $viewType == 'BusinessOffice') {{$branchName}} @else Headquarters @endif    
                <br> <span class="f-14 font-bold text-warning">{{ $counter }} total clients</span></h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">All Clients</li>
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
                    <div class="col-md-8 col-sm-12">
                        <span>Here is the details of all clients record in the database</span>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        @if ($viewType == 'BusinessOffice')
                            <a href="{{ route('add-daily-client',['id' => $branchID ?? null,'viewType' => $viewType]) }}">
                                <button class="btn btn-primary pull-right" type="button" data-bs-toggle="tooltip" title="Add new creditor">Add New Client</button>
                            </a>
                        @else
                        <a href="{{ route('addclient') }}">
                            <button class="btn btn-primary pull-right" type="button" data-bs-toggle="tooltip" title="Add new creditor">Add New Client</button>
                        </a>
                        @endif
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts')
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                      <thead>
                        <tr>
                            <th>#</th>
                          <th>Client ID</th>
                          @if ($viewType != 'BusinessOffice')
                          <th>Picture</th>
                          @endif
                          <th>Name</th>
                          <th>Phone No</th>
                          <th>Date Register</th>
                          @if ($viewType == 'BusinessOffice')
                              <th>Amount to pay next</th>
                          @else
                          <th>Next Of Kin</th>
                          @endif
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php 
                        $i = 1;
                        @endphp
                        @foreach ($clients as $client)                
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $client->client_no }}</td>
                            @if ($viewType != 'BusinessOffice')
                            <td>
                                @if($client->profile_picture)
                                    <img width="40px" src="{{ "/".$client->profile_picture }}" class="b-r-half">
                                @else 
                                    <img width="40px" src="/profile_pictures/avater.png"> 
                                @endif
                            </td>
                            @endif
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->created_at->format('M,d Y') }}</td>
                            @if ($viewType == 'BusinessOffice')
                            <td>
                            @foreach($client->monthlypayment->where('payment_status', 0) as $payment)
                            &#x20A6;{{$payment->expect_pay ?? 0}}<br>
                            <span class="text-danger">Next payday is <b>{{ date('d,M Y', strtotime($payment->next_due_date)) }}</b></span>
                            @endforeach
                            </td>
                            @else
                            <td>{{ $client->g_name }}</td>
                            @endif
                            <td>
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
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('viewclient', ['id' => $client->id, 'branchID' => $branchID, 'viewType' => $viewType]) }}">
                                        <button class="btn btn-light" type="button"><i class="fas fa-eye text-warning"></i></button>
                                    </a>
                                    @if ($viewType == 'BusinessOffice' && ($client->status == 'out of tenure' || $client->status == 0) )
                                    <a class="btn btn-success" href="{{ route('requestmonthlyloan',['client_id' => $client->id,'id' => $branchID ?? null,'viewType' => $viewType,'route_type'=> 'client']) }}">
                                        Request Loan
                                    </a>
                                    @endif
                                    @if ($viewType == 'BusinessOffice' && $client->status == 'in review')
                                    <form method="post" action="{{ route('disbursemonthlyloan') }}">
                                    @csrf
                                        <input type="hidden" name="client_id" value="{{$client->id}}">
                                        <input type="hidden" name="branch_id" value="{{$branchID}}">
                                        <input type="hidden" name="viewType" value="{{$viewType}}">
                                        <input type="hidden" name="route_type" value="client">
                                        <button class="btn btn-secondary" type="submit">Disburse</button>
                                    </form>
                                    @endif
                                    @if ($viewType == 'BusinessOffice' && ($client->status == 'in tenure' || $client->status == 'tenure extended'))
                                            <form class="f1" method="post" action="{{ route('monthlypaynow',$client->id) }}">
                                            @csrf
                                                {{--<input class="form-control" type="number" name="amount_paid" value="{{ $unpaiddetails->expect_pay}}"{{ old('amount_paid') }} required="">
                                                <input class="form-control" type="hidden" name="client_id" value="{{ $loan->client->id }}">--}}
                                                <input type="hidden" value="{{$branchID}}" name="branchID">
                                                <input type="hidden" value="{{$viewType}}" name="viewType">
                                                <input type="hidden" value="client" name="route_type">
                                                <button class="btn btn-primary" type="submit">Pay Now</button>
                                            </form> 
                                    @endif
                                    <!--<button type="button" class="btn btn-light delete-client" data-bs-toggle="modal" data-bs-target="#deleteclient" data-clientid="{{ $client->id }}" data-clientname="{{ $client->name }}"><i class="fas fa-trash-alt text-danger" data-bs-toggle="tooltip" title="Delete This Client?"></i></button>-->
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
  <script> 
    $(document).on('click', 'button.delete-client', function(){
        const clientid = $(this).data('clientid');
        const clientname = $(this).data('clientname');
        //set each form field on the modal
        const adminmodal = $("#deleteclient");
        adminmodal.find('#todel').text(clientname); 
        const url = adminmodal.find('form').attr('action');
        let urlArray = url.split('/');
        urlArray[urlArray.length - 1] = clientid;
        const newurl = urlArray.join('/');

        adminmodal.find('form').attr('action', newurl);
    });
</script>
@if ($counter > 0)  
@include('clients.popup')
@endif
@endsection
