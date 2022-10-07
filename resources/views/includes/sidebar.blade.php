<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper"><a href="">
      <img class="img-fluid for-light center" src="{{ asset('assets/images/logo/logo.png') }}" alt="" style="height: 66px;">
      <img class="img-fluid for-dark" src="assets/images/logo/logo_dark.png" style="height: 45px;" alt=""></a>
      {{-- <div class="back-btn"><i class="fa fa-angle-left"></i></div> --}}
    </div>
    <div class="logo-icon-wrapper"><a href=""><img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <a href=""><img class="img-fluid center" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="sidebar-main-title">
                <div>
                <h6 class="lan-1">General</h6>
                <p class="">Account Overview</p>
                </div>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('adminprofile*') ? 'active' : 'link-nav'}}" href="{{ route('adminprofile') }}">
                  <span class="">Your Profile</span>
              </a>
            </li>
            @if(Auth::user()->role=='Super Admin')
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('home*') ? 'active' : 'link-nav'}}" href="{{ route('home') }}">
                  <i data-feather="home" ></i>
                  <span class="">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title {{ Request::is('clients') || Request::is('addclient') ? 'active' : 'link-nav'}}" href="{{ route('clients') }}">
                <i data-feather="users"> </i><span>All Clients</span></a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title {{ Request::is('clientsintenure') ? 'active' : 'link-nav'}}" href="{{ route('clientsintenure') }}">
                <i data-feather="user"> </i><span>Clients in Tenure</span></a>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="file-text"> </i><span>Payment History</span></a>
                    <ul class="sidebar-submenu">
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('payment*') || Request::is('payout') ? 'active' : 'link-nav'}}" href="{{ route('payment') }}">Pay In</a>
                      </li>
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('payment*') || Request::is('payout') ? 'active' : 'link-nav'}}" href="{{ route('payout') }}">Pay Out(Disbursed)</a>
                      </li>
                      <li><a class="sidebar-link sidebar-title {{ Request::is('payment*') || Request::is('forwardpay') ? 'active' : 'link-nav'}}" href="{{ route('forwardpay') }}" href="">Forward Payments</a></li>
                      <li><a class="sidebar-link sidebar-title {{ Request::is('payment*') || Request::is('formpay') ? 'active' : 'link-nav'}}" href="{{ route('formpay') }}" href="">Form Payments</a></li>
                    </ul>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('loan') || Request::is('requestloan') ? 'active' : 'link-nav'}}" href="{{ route('loan') }}">
              <i data-feather="list"> </i><span>Loan History</span></a>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('adminuser') ? 'active' : 'link-nav'}}" href="{{ route('adminuser') }}">
              <i data-feather="layers"> </i><span>Admin Role</span></a>
            </li>
            @endif
            @if(Auth::user()->role=='Branch Manager' || Auth::user()->role=='Officer' )
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('home*') ? 'active' : 'link-nav'}}" href="{{ route('home') }}">
                  <i data-feather="home" ></i>
                  <span class="">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title {{ Request::is('clients') || Request::is('addclient') ? 'active' : 'link-nav'}}" href="{{ route('clients') }}">
                <i data-feather="users"> </i><span>All Clients</span></a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title {{ Request::is('clientsintenure') ? 'active' : 'link-nav'}}" href="{{ route('clientsintenure') }}">
                <i data-feather="user"> </i><span>Clients in Tenure</span></a>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('loan') || Request::is('requestloan') ? 'active' : 'link-nav'}}" href="{{ route('loan') }}">
              <i data-feather="list"> </i><span>Loan History</span></a>
            </li>
            @endif
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('monthly') ? 'active' : 'link-nav'}}" href="{{ route('monthly') }}">
              <i data-feather="calender"> </i><span>Monthly Report</span></a>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i data-feather="log-out"> </i><span>Log Out</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>              
            </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>