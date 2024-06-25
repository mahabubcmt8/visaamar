@php
    $queryString = $_SERVER['QUERY_STRING'];
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('uploads/system/').'/'.companyInfo()->admin_logo }}" alt="" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div> --}}

    <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard <i class="right fas fa-angle-left"></i></p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p> Widgets </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="javascript:" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Layout Options <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/layout/top-nav.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Top Navigation + Sidebar</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="javascript:" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-users"></i>--}}
                {{--                        <p>Run Cron <i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.rank.give.index') }}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Run Rank</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.rank.rank.commission') }}" class="nav-link">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Run Rank Commission</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item {{ Request::is('admin/user*') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-users"></i>--}}
                {{--                        <p>Users <i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.user.create') }}" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Add User</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.user.list') }}" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>User List</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.user.create') }}?agent" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Add Agent</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.user.list') }}?agent_list" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Agent List</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.rank.users') }}" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rank Users List</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.user.list') }}?blocked" class="nav-link {{ Request::is('admin/user/list') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Blocked User List</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="nav-item {{ Request::is('admin/deposit*') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/deposit*') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-wallet"></i>--}}
                {{--                        <p>Deposit List<i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.deposit.index') }}" class="nav-link {{ (($queryString != 'approved_list') && $queryString != 'rejected_list') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Pending Deposit</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.deposit.index') }}?approved_list" class="nav-link {{ $queryString == 'approved_list' ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Approved List</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.deposit.index') }}?rejected_list" class="nav-link {{ $queryString == 'rejected_list' ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rejected List</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="nav-item {{ Request::is('admin/withdraw*') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/withdraw*') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-wallet"></i>--}}
                {{--                        <p>Withdrawal List<i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.withdraw.index') }}" class="nav-link {{ (($queryString != 'approved_list') && $queryString != 'rejected_list') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Pending Withdrawal</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.withdraw.index') }}?approved_list" class="nav-link {{ $queryString == 'approved_list' ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Approved Withdrawal</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.withdraw.index') }}?rejected_list" class="nav-link {{ $queryString == 'rejected_list' ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rejected Withdrawal</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="nav-item {{ Request::is('admin/order/product*') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/order/product*') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-shopping-cart"></i>--}}
                {{--                        <p>User Product Orders<i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.index') }}" class="nav-link {{ (($queryString != 'placed_orders') && ($queryString != 'logistic_orders') && ($queryString != 'deliverd_orders')  && ($queryString != 'rejected_orders')) ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Requested Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.index') }}?placed_orders" class="nav-link {{ ($queryString == 'placed_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Placed Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.index') }}?logistic_orders" class="nav-link {{ ($queryString == 'logistic_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Process Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.index') }}?deliverd_orders" class="nav-link {{ ($queryString == 'deliverd_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Deliverd Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.index') }}?rejected_orders" class="nav-link {{ ($queryString == 'rejected_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rejected Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="nav-item {{ Request::is('admin/order/package*') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/order/package*') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-shopping-cart"></i>--}}
                {{--                        <p>User Package Orders<i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.package.index') }}" class="nav-link {{ (($queryString != 'placed_orders') && ($queryString != 'logistic_orders') && ($queryString != 'deliverd_orders')  && ($queryString != 'rejected_orders')) ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Requested Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.package.index') }}?placed_orders" class="nav-link {{ ($queryString == 'placed_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Placed Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.package.index') }}?logistic_orders" class="nav-link {{ ($queryString == 'logistic_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Process Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.package.index') }}?deliverd_orders" class="nav-link {{ ($queryString == 'deliverd_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Deliverd Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.order.package.index') }}?rejected_orders" class="nav-link {{ ($queryString == 'rejected_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rejected Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="nav-item {{ Request::is('admin/purchase*') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/purchase*') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-shopping-bag"></i>--}}
                {{--                        <p>Agent Product Orders<i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.index') }}" class="nav-link {{ (($queryString != 'placed_orders') && ($queryString != 'logistic_orders') && ($queryString != 'deliverd_orders')  && ($queryString != 'rejected_orders')) ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Requested Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.index') }}?placed_orders" class="nav-link {{ ($queryString == 'placed_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Placed Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.index') }}?logistic_orders" class="nav-link {{ ($queryString == 'logistic_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Process Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.index') }}?deliverd_orders" class="nav-link {{ ($queryString == 'deliverd_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Deliverd Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.index') }}?rejected_orders" class="nav-link {{ ($queryString == 'rejected_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rejected Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="nav-item {{ Request::is('admin/purchase/package') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/purchase/package') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-shopping-bag"></i>--}}
                {{--                        <p>Agent Package Orders<i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.package.index') }}" class="nav-link {{ (($queryString != 'placed_orders') && ($queryString != 'logistic_orders') && ($queryString != 'deliverd_orders')  && ($queryString != 'rejected_orders')) ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Requested Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.package.index') }}?placed_orders" class="nav-link {{ ($queryString == 'placed_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Placed Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.package.index') }}?logistic_orders" class="nav-link {{ ($queryString == 'logistic_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Process Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.package.index') }}?deliverd_orders" class="nav-link {{ ($queryString == 'deliverd_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Deliverd Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.purchase.package.index') }}?rejected_orders" class="nav-link {{ ($queryString == 'rejected_orders') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rejected Orders</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="nav-item {{ Request::is('admin/rank*') ? 'menu-open' : '' }} {{ Request::is('admin/generation*') ? 'menu-open' : '' }} {{ Request::is('admin/club_bonus_details*') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/rank*') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-suitcase"></i>--}}
                {{--                        <p>Business Configuration <i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.rank.index') }}" class="nav-link {{ Request::is('admin/rank*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Rank</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        --}}{{-- <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.leadership.index') }}" class="nav-link {{ Request::is('admin/leadership*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Leadership</p>--}}
                {{--                            </a>--}}
                {{--                        </li> --}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.generation.index') }}" class="nav-link {{ Request::is('admin/generation*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Generation</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.club_bonus_details.index') }}" class="nav-link {{ Request::is('admin/club_bonus_details*') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>Club Bonus Details</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}

                <li class="nav-item {{ Request::is('admin/categories') ? 'menu-open' : '' }} {{ Request::is('admin/subcategory') ? 'menu-open' : '' }} {{ Request::is('admin/product*') ? 'menu-open' : '' }}  {{ Request::is('admin/package*') ? 'menu-open' : '' }}">
                    <a href="javascript:" class="nav-link {{ Request::is('admin/product*') ? 'active' : '' }} {{ Request::is('admin/subcategory') ? 'active' : '' }} {{ Request::is('admin/product*') ? 'active' : '' }}">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>Land and property <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link {{ Request::is('admin/categories') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subcategory.index') }}" class="nav-link {{ Request::is('admin/subcategory') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.division.index') }}" class="nav-link {{ Request::is('admin/division') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Add Division</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.district.index') }}" class="nav-link {{ Request::is('admin/district') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Add District</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.upazila.index') }}" class="nav-link {{ Request::is('admin/upazila') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Add Upazila</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link {{ Request::is('admin/product*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Land and property</p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('admin.package.index') }}" class="nav-link {{ Request::is('admin/package*') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Packages</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </li>




                {{--                <li class="nav-item">--}}
{{--                    <a href="javascript: void(0);" class="has-arrow waves-effect">--}}
{{--                        <p>Category Module<i class="fas fa-angle-left right"></i></p>--}}
{{--                    </a>--}}
{{--                    <ul class="sub-menu" aria-expanded="true">--}}
{{--                        <li><a href="{{route('admin.about.add')}}">Add Category</a></li>--}}
{{--                        <li><a href="">Manage Category</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                {{--                <li class="nav-item {{ Request::is('admin/transaction') ? 'menu-open' : '' }}">--}}
                {{--                    <a href="javascript:" class="nav-link {{ Request::is('admin/settings/company-info') ? 'active' : '' }} {{ Request::is('admin/settings/home/home-page') ? 'active' : '' }}">--}}
                {{--                        <i class="nav-icon fas fa-cog"></i>--}}
                {{--                        <p>Transection <i class="fas fa-angle-left right"></i> </p>--}}
                {{--                    </a>--}}
                {{--                    <ul class="nav nav-treeview">--}}
                {{--                        <li class="nav-item">--}}
                {{--                            <a href="{{ route('admin.transaction.index') }}" class="nav-link {{ Request::is('admin/transaction') ? 'active' : '' }}">--}}
                {{--                                <i class="far fa-circle nav-icon"></i>--}}
                {{--                                <p>All Transections</p>--}}
                {{--                            </a>--}}
                {{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}

                <li class="nav-item {{ Request::is('admin/settings/company-info') ? 'menu-open' : '' }} {{ Request::is('admin/settings/home/home-page') ? 'menu-open' : '' }} {{ Request::is('admin/settings/country') ? 'menu-open' : '' }}  {{ Request::is('admin/settings/state') ? 'menu-open' : '' }}">
                    <a href="javascript:" class="nav-link {{ Request::is('admin/settings/company-info') ? 'active' : '' }} {{ Request::is('admin/settings/home/home-page') ? 'active' : '' }}  {{ Request::is('admin/settings/state') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings <i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ Request::is('admin/settings/company-info') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Company Info</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.home.index') }}" class="nav-link {{ Request::is('admin/settings/home/home-page') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Page Settings</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.settings.about.index') }}" class="nav-link {{ Request::is('admin/settings/about/about-page') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>About Settings</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.settings.contact.index') }}" class="nav-link {{ Request::is('admin/settings/contact/contact-page') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact Settings</p>
                            </a>
                        </li>
{{--                        <li class="nav-item" >--}}
{{--                            <a href="{{ route('admin.settings.about.index') }}"  class="nav-link {{ Request::is('admin/settings/about/about-page') ? 'active' : '' }}">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>About Section</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}



                        <li class="nav-item">
                        <li class="nav-item {{ Request::is('admin/settings/division') ? 'menu-open' : '' }} {{ Request::is('admin/settings/district') ? 'menu-open' : '' }}">
                            <a href="javascript:" class="nav-link  {{ Request::is('admin/settings/division') ? 'active' : '' }}   {{ Request::is('admin/settings/district') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Country Config <i class="fas fa-angle-left right"></i> </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.settings.division.index') }}" class="nav-link {{ Request::is('admin/settings/division') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Division</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.settings.district.index') }}" class="nav-link {{ Request::is('admin/settings/district') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add District</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.settings.upazila.index') }}" class="nav-link {{ Request::is('admin/settings/upazila') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Upazila</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a type="button" class="nav-link" href="{{ route('admin.logout') }}"onclick="event.preventDefault();this.closest('form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i> <p> Logout </p></a>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
