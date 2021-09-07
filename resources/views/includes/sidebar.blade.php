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
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('home') }}">
                  <i data-feather="home" ></i>
                  <span class="">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title link-nav" href="{{ route('clients') }}">
                <i data-feather="users"> </i><span>All Clients</span></a>
            </li>
            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title link-nav" href="{{ route('clientsintenure') }}">
                <i data-feather="user"> </i><span>Clients in Tenure</span></a>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('payment') }}">
              <i data-feather="file-text"> </i><span>Payment</span></a>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('loan') }}">
              <i data-feather="list"> </i><span>Loan History</span></a>
            </li>
            <li class="sidebar-list">
              <a class="sidebar-link sidebar-title link-nav" href="{{ route('adminuser') }}">
              <i data-feather="layers"> </i><span>Admin Role</span></a>
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
<style>
  .activity a{
    color: #455668 !important;
  }
</style>
{{-- @if(Auth::user()->role=='Administrator')
<ul class="sidebar-menu">
    <li class="{{ Request::is('dashboard') || Request::is('/') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-th-large"></i><span>Dashboard</span></a>
    </li>
@endif --}}
               