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
                        <a href="{{ route('user.profile.index') }}"><i class="ti-user"></i>Profile</a>
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

        <ul class="pcoded-item pcoded-left-item mt-4">
            <li class="active">
                <a href="{{ route('user.home') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

        </ul>

        {{-- <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Account</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Bonus Report</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="">
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Trade Profit</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="">
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Partners</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

        </ul> --}}

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Users</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/clients*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-user-o"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">User</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/clients/create')  ? 'active' : '' }}">
                        <a href="{{ route('user.client.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">User Create</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/clients')  ? 'active' : '' }}">
                        <a href="{{ route('user.client.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">User List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Refer</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/refer*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-share-alt-square"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Refers</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/refer')  ? 'active' : '' }}">
                        <a href="{{ route('user.refer.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Refer List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/refer/team/count')  ? 'active' : '' }}">
                        <a href="{{ route('user.refer.team.count') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Team User Count</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Stock</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/stock/stock/list*')  ? 'active pcoded-trigger' : '' }} {{ Request::is('user/stock/stock/package*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Stock Reports


                    </span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/stock/stock/list')  ? 'active' : '' }}">
                        <a href="{{ route('user.stock.list') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Product Stock List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/stock/stock/package')  ? 'active' : '' }}">
                        <a href="{{ route('user.stock.package.list') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Package Stock List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">My Purchases</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/purchase*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Purchases</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ Request::is('user/purchase/create')  ? 'active' : '' }}">
                        <a href="{{ route('user.purchase.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Product Purchase</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/purchase')  ? 'active' : '' }}">
                        <a href="{{ route('user.purchase.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Product Purchase List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/purchase/package/create')  ? 'active' : '' }}">
                        <a href="{{ route('user.purchase.package.create') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Package Purchase</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ Request::is('user/purchase/package')  ? 'active' : '' }}">
                        <a href="{{ route('user.purchase.package.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Package Purchase List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">User Orders</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu {{ Request::is('user/order/create*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="{{ route('user.order.create') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">New Orders</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            <li class="pcoded-hasmenu {{ Request::is('user/order/product*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Product Orders</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ (($queryString != 'placed_orders') && ($queryString != 'logistic_orders') && ($queryString != 'deliverd_orders')  && ($queryString != 'rejected_orders')) ? 'active' : '' }}">
                        <a href="{{ route('user.order.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Request Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'placed_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.index') }}?placed_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Placed Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'logistic_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.index') }}?logistic_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Process Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'deliverd_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.index') }}?deliverd_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Deliverd Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'rejected_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.index') }}?rejected_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Rejected Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pcoded-hasmenu {{ Request::is('user/order/package*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Package Orders</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    {{-- <li class="{{ (($queryString != 'placed_orders') && ($queryString != 'logistic_orders') && ($queryString != 'deliverd_orders')  && ($queryString != 'rejected_orders')) ? 'active' : '' }}">
                        <a href="{{ route('user.order.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Request Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li> --}}
                    <li class="{{ ($queryString == 'placed_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.package.index') }}?placed_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Placed Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'logistic_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.package.index') }}?logistic_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Process Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'deliverd_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.package.index') }}?deliverd_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Deliverd Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'rejected_orders') ? 'active' : '' }}">
                        <a href="{{ route('user.order.package.index') }}?rejected_orders" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Rejected Orders</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Finance
        </div>
        <ul class="pcoded-item pcoded-left-item">
            {{-- <li class="{{ Request::is('user/deposit*')  ? 'active' : '' }}">
                <a href="{{ route('user.deposit.index') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Deposit</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li> --}}

            <li class="pcoded-hasmenu {{ Request::is('user/deposit*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Deposit</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ (($queryString != 'approved_list') && $queryString != 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.deposit.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Pending Deposit</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'approved_list') ? 'active' : '' }}">
                        <a href="{{ route('user.deposit.index') }}?approved_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Approved Deposit</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.deposit.index') }}?rejected_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Rejected Deposit</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>
{{--
            <li>
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Update Deposit</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li> --}}

            <li class="pcoded-hasmenu  {{ Request::is('user/withdraw*')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style3" subitem-icon="style7">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">My Withdraw</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ (($queryString != 'approved_list') && $queryString != 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.withdraw.index') }}" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Pending Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'approved_list') ? 'active' : '' }}">
                        <a href="{{ route('user.withdraw.index') }}?approved_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Approved Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li class="{{ ($queryString == 'rejected_list') ? 'active' : '' }}">
                        <a href="{{ route('user.withdraw.index') }}?rejected_list" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Rejected Withdraw</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Others</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">KYC Verification</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

        </ul>

        <div class="pcoded-navigation-label" data-i18n="nav.category.other">Settings</div>
        <ul class="pcoded-item pcoded-left-item">
            <li>
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.form-components.main">Settings</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
    </div>
</nav>
