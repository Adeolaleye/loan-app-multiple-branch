<div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar sticky">
                    <div class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li>
                                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a>
                            </li>
                            <li class="{{ Request::is('overview') || Request::is('/') ? 'active' : '' }}">
                                <a href="{{ route('overview') }}" class="nav-link">Overview</a>
                            </li>
                            <li class="{{ Request::is('payment') || Request::is('/') ? 'active' : '' }}">
                                <a href="{{ route('payment') }}" class="nav-link links">Payments</a>
                            </li>
                            <li class="{{ Request::is('payout') || Request::is('/') ? 'active' : '' }}">
                                <a href="{{ route('payment') }}" class="nav-link links">Payouts</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav navbar-right">
                        <li>
                            <form class="form-inline mr-auto">
                                <div class="search-element">
                                    <input class="form-control" type="search" placeholder="Search Konveyos Payment, Orders and More..." aria-label="Search" data-width="430" />
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li class="dropdown dropdown-list-toggle">
                            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i data-feather="bell" class="bell"></i> <span class="badge headerBadge1"> 6 </span> </a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                                <div class="dropdown-header">
                                    Notification
                                    <div class="float-right">
                                        <a href="#">Mark All As Read</a>
                                    </div>
                                </div>
                                <div class="dropdown-list-content dropdown-list-message">
                                    <a href="#" class="dropdown-item">
                                        <span class="dropdown-item-desc">
                                            <span class="message-user">Sarah Smith</span> <span class="time messege-text">Request for leave application</span>
                                            <span class="time">5 Min Ago</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user"> <img alt="image" src="{{ asset("assets/img/avater.png") }}" class="user-img-radious-style" /></a>
                        </li>
                        <li>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span style="font-size: 11px;">{{ Auth::user()->role }}</span>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"><i class="fas fa-angle-down"></i> <span class="d-sm-none d-lg-inline-block"></span></a>
                            <div class="dropdown-menu dropdown-menu-right pullDown">
                                <a href="" class="dropdown-item has-icon"> <i class="far fa-user"></i> Profile </a>
                                <a href="" class="dropdown-item has-icon">
                                    <i class="fas fa-bolt"></i>
                                    Activities
                                </a>
                                <a href="" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                           this.closest('form').submit();" class="dropdown-item has-icon text-danger">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>