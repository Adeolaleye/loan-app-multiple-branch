@extends('layouts.main') 
@section('title','Admins') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>All Adminstrator <br> <span class="f-14 font-bold text-warning">{{ $counter }} total admins</span></h3>
                
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">All admins</li>
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
                        <span>Here are administrator</span>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <button class="btn btn-primary pull-right" type="button" data-bs-toggle="modal" data-bs-target="#addadmin" data-bs-toggle="tooltip" title="Add Admin">Create Admin</button>
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
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Role</th>
                            <th>Date Added</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php 
                        $i = 1;
                        @endphp
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                @if($user->profile_picture)
                                    <img width="40px" src="{{ "/".$user->profile_picture }}" class="b-r-half">
                                @else 
                                    <img width="40px" src="/profile_pictures/avater.png"> 
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->created_at->format('M ,d Y') }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button class="btn btn-light edit-user" type="button" data-bs-toggle="modal" data-bs-target="#editadmin" data-userid="{{ $user->id }}" data-user="{{ json_encode($user->toArray()) }}" data-bs-toggle="tooltip" title="Edit Admin"><i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <button type="button" class="btn btn-light delete-user" data-bs-toggle="modal" data-bs-target="#deleteadmin" data-userid="{{ $user->id }}" data-username="{{ $user->name }}" data-bs-toggle="tooltip" title="Delete This Admin"><i class="fas fa-trash-alt text-danger"></i></button>
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
        $(document).on('click', 'button.edit-user', function(){
            const userid = $(this).data('userid');
            const user = $(this).data('user');
            //set each form field on the modal
            const adminmodal = $("#editadmin");
            adminmodal.find('[name="name"]').val(user.name);
            adminmodal.find('[name="email"]').val(user.email);
            adminmodal.find('[name="phone"]').val(user.phone);
            adminmodal.find('[name="role"]').val(user.role);
            adminmodal.find('[name="profile_picture"]').val(user.profile_picture);

            const url = adminmodal.find('form').attr('action');
            let urlArray = url.split('/');
            urlArray[urlArray.length - 1] = userid;
            const newurl = urlArray.join('/');

            adminmodal.find('form').attr('action', newurl);
        });  
        $(document).on('click', 'button.delete-user', function(){
            const userid = $(this).data('userid');
            const username = $(this).data('username');
            const userdate = $(this).data('userdate');
            //set each form field on the modal
            const adminmodal = $("#deleteadmin");
            adminmodal.find('#todel').text(username);            
            adminmodal.find('#date').text(userdate); 
            const url = adminmodal.find('form').attr('action');
            let urlArray = url.split('/');
            urlArray[urlArray.length - 1] = userid;
            const newurl = urlArray.join('/');

            adminmodal.find('form').attr('action', newurl);
        });
</script>
@include('adminuser.popup')
@include('includes.toastr')

@endsection

