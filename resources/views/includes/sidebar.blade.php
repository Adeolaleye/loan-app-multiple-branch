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
      @php
          $viewType = isset($type) ? $type : request()->query('viewType');
          $id = isset($id) ? $id : null;
          $branchName = isset($branchN) ? $branchN : $branchName;
          $branchID = !isset($branchID) ? $id : $branchID;
      @endphp
        @if ($viewType == 'BusinessOffice')
        <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <a href=""><img class="img-fluid center" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="sidebar-main-title">
                <div>
                <h6 class="lan-1">Account Overview</h6>
                <p class="">{{ $branchName ?? 'Headquarters' }}</p>
                </div>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('adminprofile*') ? 'active' : 'link-nav'}}" href="{{ route('adminprofile', ['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">
                  <span class="">Your Profile</span>
              </a>
            </li>
            {{--@if(Auth::user()->role=='Super Admin')--}}
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('business-office-dashboard*') ? 'active' : 'link-nav'}}" href="{{route('business-office-dashboard',['id' => $branchID ?? null,'viewType' => 'BusinessOffice'])}}">
                  <i data-feather="home" ></i>
                  <span class="">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title {{ Request::is('clients') || Request::is('addclient') ? 'active' : 'link-nav'}}" href="{{ route('clients',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">
                <i data-feather="users"> </i><span>All Clients</span></a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title {{ Request::is('viewmonthlytenureclient') ? 'active' : 'link-nav'}}" href="{{ route('viewmonthlytenureclient',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">
                <i data-feather="user"> </i><span>Monthly Tenure Client</span></a>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('viewmonthlyloan') || Request::is('requestmonthlyloan') ? 'active' : 'link-nav'}}" href="{{ route('viewmonthlyloan',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">
              <i data-feather="list"> </i><span>Monthly Loan History</span></a>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="file-text"> </i><span>Payment History</span></a>
                    <ul class="sidebar-submenu">
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('payment*') || Request::is('monthlypayin') ? 'active' : 'link-nav'}}" href="{{ route('monthlypayin',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">Pay In</a>
                      </li>
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('payment*') || Request::is('payout') ? 'active' : 'link-nav'}}" href="{{ route('monthlyclientpayout',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">Pay Out(Disbursed)</a>
                      </li>
                      <li><a class="sidebar-link sidebar-title {{ Request::is('payment*') || Request::is('formpay') ? 'active' : 'link-nav'}}" href="{{ route('monthlyformpayment',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}" href="">Form Payments</a></li>
                    </ul>
            </li>
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="file-text"> </i><span>Reports</span></a>
                    <ul class="sidebar-submenu">
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('daily') ? 'active' : 'link-nav'}}" href="{{ route('daily',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">Daily Report</a>
                      </li>
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('dailydefaulter') ? 'active' : 'link-nav'}}" href="{{ route('dailydefaulter',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">Defaulters</a>
                      </li>
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('dailytenureextended') ? 'active' : 'link-nav'}}" href="{{ route('dailytenureextended',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">Tenure Extended</a>
                      </li>
                    </ul>
            </li>
            {{--@endif--}}
            @if(Auth::user()->role=='Branch Manager' || Auth::user()->role=='Officer' )
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('home*') ? 'active' : 'link-nav'}}" href="{{ route('home') }}">
                  <i data-feather="home" ></i>
                  <span class="">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title {{ Request::is('clients') || Request::is('addclient') ? 'active' : 'link-nav'}}" href="{{ route('clients',['id' => $branchID ?? null,'viewType' => 'BusinessOffice']) }}">
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
        @else
        <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <a href=""><img class="img-fluid center" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="sidebar-main-title">
                <div>
                <h6 class="lan-1">Account Overview</h6>
                <p class="">Headquaters</p>
                </div>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title {{ Request::is('adminprofile*') ? 'active' : 'link-nav'}}" href="{{ route('adminprofile', ['id' => $branchID ?? null, 'viewType' => 'HeadQuarter'])}}">
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
                <a class="sidebar-link sidebar-title {{ Request::is('clients') || Request::is('addclient') ? 'active' : 'link-nav'}}" href="{{ route('clients', ['id' => $branchID ?? null]) }}">
                  <i data-feather="users"></i>
                  <span>All Clients</span>
                </a>
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
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="file-text"> </i><span>Reports</span></a>
                    <ul class="sidebar-submenu">
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('monthly') ? 'active' : 'link-nav'}}" href="{{ route('monthly') }}">Monthly Report</a>
                      </li>
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('defaulter') ? 'active' : 'link-nav'}}" href="{{ route('defaulter') }}">Defaulters</a>
                      </li>
                      <li>
                        <a class="sidebar-link sidebar-title {{ Request::is('tenureextended') ? 'active' : 'link-nav'}}" href="{{ route('tenureextended') }}">Tenure Extended</a>
                      </li>
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
                <a class="sidebar-link sidebar-title {{ Request::is('clients') || Request::is('addclient') ? 'active' : 'link-nav'}}" href="{{ route('clients', ['id' => $branchID ?? null]) }}">
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
        @endif
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>