@extends('layouts.main') 
@section('title','View Details') 
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Admin Profile </h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="">Profile</a>
                    </li>
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
                    @if(auth()->user()->profile_picture)
                        <img src="{{ "/".auth()->user()->profile_picture }}" class="b-r-half">
                    @else 
                        <img src="/profile_pictures/avater.png"> 
                    @endif
                </div>
              <div class="icon-wrapper" data-bs-toggle="tooltip" title="Edit Client">
                <a href="#edit"><i class="fas fa-edit text-mute"></i></a>  
                </div>
            </div>
            <div class="info">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ttl-info text-start text-center">
                                <h6>Email</h6><span>{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                    <div class="user-designation">
                        <div class="title"><a target="_blank" href="#">{{ Auth::user()->name }}</a></div>
                        <div class="desc">{{ Auth::user()->role }}</div>
                        <a href="" data-bs-toggle="tooltip" title="Click to view loan history">
                                <div class="span badge rounded-pill pill-badge-secondary">Active</div>
                        </a>
                        {{-- <div class="span badge rounded-pill pill-badge-secondary">Out Of Tenure</div> --}}
                    </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ttl-info text-start text-center">
                                <h6> Phone No</h6><span>{{ Auth::user()->phone }}</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <hr>
                <div id="edit" class="">
                    @include('includes.alerts')
                    <h4>Edit Your Profile</h4>
                    <form method="post" action="{{ route('update', Auth::user()->id) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 m-t-20">
                                    <label class="col-form-label" for="fullname">Fullname</label>
                                    <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-sm-12 col-lg-6 m-t-20">
                                    <label class="col-form-label" for="phone">Phone No</label>
                                    <input class="form-control" type="text" name="phone" value="{{ Auth::user()->phone }}" required>
                                </div>
                                <div class="col-sm-12 col-lg-6 m-t-20">
                                    <label class="col-form-label" for="email">Email Address</label>
                                    <input class="form-control" type="email" value="{{ Auth::user()->email }}" name="email" required>
                                </div>
                                <div class="col-sm-12 col-lg-6 m-t-20">
                                    <label class="col-form-label" for="password">Password (not required)</label>
                                    <input class="form-control" type="password" value="" name="password" minlength="6" >
                                </div>
                                <div class="col-sm-12 col-lg-6 m-t-20">
                                    <label class="col-form-label">Role</label>
                                    <select class="form-control" name="role" required>
                                        <option value="{{ Auth::user()->role }}">{{ Auth::user()->role }}</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6 m-t-20">
                                    <label class="col-form-label" for="profile_picture">Profile Picture (Optional)</label>
                                    <input class="form-control" type="file" name="profile_picture">
                                </div>
                                    <button type="submit" class="btn btn-primary m-t-30">Update</button>
                            </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection