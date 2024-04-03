@php
    $viewType = isset($type) ? $type : request()->query('viewType');
    $id = isset($id) ? $id : null;
    $branchName = isset($branchN) ? $branchN : $branchName;
    $branchID = !isset($branchID) ? $id : $branchID;
@endphp
@if ($viewType == 'BusinessOffice' || isset($branchID))
<div class="page-header">
  <div class="header-wrapper row m-0">
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper">
        <a href=""><img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt="" style="height: 45px;"></a>
      </div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
      <ul class="horizontal-menu">
        <li class="onhover-dropdown">
          <a href="">
            <button class="btn btn-primary pull-right" type="button">This is Business Office {{ $branchName ?? null }}</button>
          </a>
          @if (Auth::user()->role !== 'Business Branch Manager')
          <ul class="profile-dropdown onhover-show-div">
            @foreach ($branches as $branch)
              <li><a href="{{route('business-office-dashboard',['id' => $branch->id,'viewType' => 'BusinessOffice'])}}">{{$branch->name}}</a></li>
            @endforeach  
            @if ($viewType == 'BusinessOffice')
                <li><a href="{{route('home',['viewType' => 'HeadQuarter'])}}">Headquarters</a></li>
            @endif              
          </ul>
          @endif
        </li>
      </ul>
    </div>
    <div class="nav-right col-8 pull-right right-header p-0">
      <ul class="nav-menus">
        <li class="text-center"><h5><span id="greeting"></span> {{ Auth::user()->name }}, </h5></li>
        <li class="maximize">
            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a>
        </li>
        <li class="profile-nav onhover-dropdown p-0 me-0">
            <div class="media profile-media">
              <img alt="image" 
                @if(auth()->user()->profile_picture) src="{{ "/".auth()->user()->profile_picture }}" 
                @else src="/profile_pictures/avater.png" 
                @endif class="b-r-half" width="45px">
            <div class="media-body"><span>{{ Auth::user()->name }}</span>
                <p class="mb-0 font-roboto">{{ Auth::user()->role }} <i class="middle fa fa-angle-down"></i></p>
            </div>
            </div>
            <ul class="profile-dropdown onhover-show-div">
              <li><a href="{{ route('adminprofile') }}"><i data-feather="user"></i><span>Profile </span></a></li>
              <li>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i data-feather="log-out"> </i><span>Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>              
              </li>           
            </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
@else
<div class="page-header">
  <div class="header-wrapper row m-0">
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper">
        <a href=""><img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt="" style="height: 45px;"></a>
      </div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col horizontal-wrapper ps-0">
      <ul class="horizontal-menu">
        <li class="onhover-dropdown">
          <a href="">
            <button class="btn btn-primary pull-right" type="button">Switch To Business Office</button>
          </a>
          <ul class="profile-dropdown onhover-show-div">
            @foreach ($branches as $branch)
              <li><a href="{{route('business-office-dashboard',['id' => $branch->id,'viewType' => 'BusinessOffice'])}}">{{$branch->name}}</a></li>
            @endforeach          
          </ul>
        </li>
      </ul>
    </div>
    <div class="nav-right col-8 pull-right right-header p-0">
      <ul class="nav-menus">
        <li class="text-center"><h5><span id="greeting"></span> {{ Auth::user()->name }}, </h5></li>
        <li class="maximize">
            <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a>
        </li>
        <li class="profile-nav onhover-dropdown p-0 me-0">
            <div class="media profile-media">
              <img alt="image" 
                @if(auth()->user()->profile_picture) src="{{ "/".auth()->user()->profile_picture }}" 
                @else src="/profile_pictures/avater.png" 
                @endif class="b-r-half" width="45px">
            <div class="media-body"><span>{{ Auth::user()->name }}</span>
                <p class="mb-0 font-roboto">{{ Auth::user()->role }} <i class="middle fa fa-angle-down"></i></p>
            </div>
            </div>
            <ul class="profile-dropdown onhover-show-div">
              <li><a href="{{ route('adminprofile') }}"><i data-feather="user"></i><span>Profile </span></a></li>
              <li>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i data-feather="log-out"> </i><span>Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>              
              </li>           
            </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
@endif