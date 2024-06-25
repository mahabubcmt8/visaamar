@php
    $queryString = $_SERVER['QUERY_STRING'];
@endphp
<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="{{ (Auth::user()->image != null) ? asset('uploads/user/profile/'.Auth::user()->image) : asset('user/assets/images/avatar-blank.jpg') }}"
                    alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{ Auth::user()->name }}<i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                        <a href="{{ route('user.customer.profile.index') }}"><i class="ti-user"></i>Profile</a>
                        <a href="#!"><i class="ti-settings"></i>Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="ti-layout-sidebar-left"></i> {{ __('Log Out') }}
                            </a>
                        </form>
                        {{-- <a href="auth-normal-sign-in.html"><i
                                class="ti-layout-sidebar-left"></i>Logout</a> --}}
                    </li>
                </ul>
            </div>
        </div>
        {{-- <div class="p-15 p-b-0">
            <form class="form-material">
                <div class="form-group form-primary">
                    <input type="text" name="footer-email" class="form-control"
                        required="">
                    <span class="form-bar"></span>
                    <label class="float-label"><i class="fa fa-search m-r-10"></i>Search
                        Friend</label>
                </div>
            </form>
        </div> --}}

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Dashboard</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="active">
                <a href="{{ route('shop') }}" class="waves-effect waves-dark mb-2">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Go Shop</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('user.customer.home') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Refer</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/customer/refer*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-share-alt-square"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Teams</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/customer/refer')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.refer.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Refer List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/customer/refer/team/count')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.refer.team.count') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Team User Count</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/customer/refer/team/sales')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.refer.team.sales') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Team User Sales</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Finance
        </div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu  {{ Request::is('user/customer/withdraw*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Withdraw</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ (($queryString != 'approved_list') && $queryString != 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.withdraw.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Pending Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'approved_list') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.withdraw.index') }}?approved_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Approved Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.withdraw.index') }}?rejected_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Rejected Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Orders</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/customer/order*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Orders</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ ($queryString != 'deliverd') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.order.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'deliverd') ? 'active' : '' }}">
                        <a href="{{ route('user.customer.order.index') }}?deliverd" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Deliverd Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Reports</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/customer/reports*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Available Balance</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/customer/reports*')  ? 'active' : '' }}">
                        <a href="{{ route('user.customer.reports.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">All Commissions</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

    </div>
</nav>
