@extends('layouts.main') 
@section('title','All Clients') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Registered Clients <br> <span class="f-14 font-bold text-warning">{{ $counter }} total clients</span></h3>
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
                        <span>Here is the details of all clients record in the database</span><br><span>Click on the eye button to view full details of client, and basket icon to trash client.</span>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <a href="{{ route('addclient') }}">
                            <button class="btn btn-primary pull-right" type="button" data-bs-toggle="tooltip" title="Add new creditor">Add New Client</button>
                        </a>
                    </div>
                </div>
              </div>
              <div class="card-body">
                  @include('includes.alerts')
                <div class="table-responsive">
                    <table class="display" id="advance-1">
                      <thead>
                        <tr>
                          <th>Client ID #</th>
                          <th>Picture</th>
                          <th>Name</th>
                          <th>Phone No</th>
                          <th>Date Register</th>
                          <th>Next Of Kin</th>
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
                            <td>{{ $client->client_no }}</td>
                            <td>
                                @if($client->profile_picture)
                                    <img width="40px" src="{{ "/".$client->profile_picture }}" class="b-r-half">
                                @else 
                                    <img width="40px" src="/profile_pictures/avater.png"> 
                                @endif
                            </td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->created_at->format('M ,d Y') }}</td>
                            <td>{{ $client->g_name }}</td>
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
                                    <a href="{{ route('viewclient',$client->id) }}">
                                        <button class="btn btn-light" type="button"><i class="fas fa-eye text-warning"></i></button>
                                    </a>
                                    <button type="button" class="btn btn-light delete-client" data-bs-toggle="modal" data-bs-target="#deleteclient" data-clientid="{{ $client->id }}" data-clientname="{{ $client->name }}"><i class="fas fa-trash-alt text-danger" data-bs-toggle="tooltip" title="Delete This Client?"></i></button>
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
        adminmodal.find('#todel2').text(clientname); 
        const url = adminmodal.find('form').attr('action');
        let urlArray = url.split('/');
        urlArray[urlArray.length - 1] = clientid;
        const newurl = urlArray.join('/');

        adminmodal.find('form').attr('action', newurl);
    });
</script>
@include('clients.popup')
@endsection
