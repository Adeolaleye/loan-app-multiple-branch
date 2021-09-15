<div class="page-header">
    <div class="header-wrapper row m-0">
      <form class="form-inline search-full col" action="#" method="get">
        <div class="form-group w-100">
          <div class="Typeahead Typeahead--twitterUsers">
            <div class="u-posRelative">
              <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
              <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
            </div>
            <div class="Typeahead-menu"></div>
          </div>
        </div>
      </form>
      {{-- <div class="col-md-1"></div> --}}
      <div class="header-logo-wrapper col-auto p-0">
        <div class="logo-wrapper">
          <a href=""><img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt="" style="height: 45px;"></a>
        </div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
      </div>
      <div class="nav-right col-8 pull-right right-header p-0">
        <ul class="nav-menus">
          <li class="text-center"><h5><span id="greeting"></span> {{ Auth::user()->name }}, </h5></li>
          <li><span class="header-search"><i data-feather="search"></i></span></li>
          <li class="maximize">
              <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a>
          </li>
          <li class="onhover-dropdown">
              <div class="notification-box">
                  <i data-feather="bell"> </i>
                  <span class="badge rounded-pill badge-secondary">4</span>
              </div>
              {{-- <ul class="notification-dropdown onhover-show-div">
                  <li>
                      <i data-feather="bell"></i>
                      <h6 class="f-18 mb-0">Notitications</h6>
                  </li>
                  <li>
                      <p>
                          <i class="fa fa-circle-o me-3 font-primary"> </i>
                          Disbursement
                          <span class="pull-right">10 min.</span>
                      </p>
                  </li>
                  <li>
                      <p><i class="fa fa-circle-o me-3 font-success"></i>
                          Payment
                          <span class="pull-right">1 hr</span>
                      </p>
                  </li>
                  <li>
                      <a class="btn btn-primary" href="#">Check all notification</a>
                  </li>
              </ul> --}}
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
              <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i data-feather="log-out"> </i><span>Log Out</span></a>
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