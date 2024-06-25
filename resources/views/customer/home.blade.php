@extends('layouts.customer.app')

@section('content')

<style>
    .card.bonus-card {
        min-height: 42vh;
    }
    ul#pills-tab .nav-link {
        border: none;
        background: #fff;
        margin-right: 5px;
        padding: 3px 8px;
    }
    ul#pills-tab .nav-link:focus{
        outline: none;
    }

    .card-profile-img {
        margin: auto;
        vertical-align: middle;
        text-align: center;
    }
    .card-profile-details {
        margin: auto;
        text-align: center;
        margin-top: 13px;
    }

    .card-profile-img img {
        width: 50%;
        text-align: center;
        margin: auto;
        border: 1px solid #74a532;
        border-radius: 50%;
        padding: 2px;
    }


    .card-profile-details {

        font-size: 14px;
        color: #333;
        margin-top: 5px;
        text-align: left;
    }

    .card-profile-details h5 {
        font-size: 16px;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-align: center;
    }
    .card-profile-details p{
        text-align: center;
    }

    @media (max-width: 600px) {
        .page-header{
            display: none;
        }
    }
</style>
<!-- Page-header start -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">{{ $pageTitle }}</h5>
                    <p class="m-b-0">Welcome to Ayurgreen</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Page-header end -->
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-md-12 col-lg-3 mb-3">
                        <div class="card animated-button1">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <div class="card-block">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="card-profile-img">
                                            <img src="{{ (Auth::user()->image != null) ? asset('uploads/user/profile/'.Auth::user()->image) : asset('user/assets/images/avatar-blank.jpg') }}" class="img-radius"alt="User-Profile-Image">
                                        </div>
                                        <div class="card-profile-details">
                                            <h5>{{ Auth::user()->name }}</h5>
                                            <p>{{ Auth::user()->username }}</p>
                                            <div class="form-group">
                                                <label for="">Designation</label>
                                                <input type="text" value="{{ (Auth::user()->rank != false ) ? Auth::user()->rank->rankInfo->name : 'N/A' }}" class="form-control" style="text-transform: capitalize;" readonly>



                                                {{ auth()->user()->countryInfo->name }}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-9 mb-3">
                        <div class="row">
                            <!-- task, page, download counter  start -->
                            <div class="col-xl-4 col-md-6 col-sm-12 pb-3">
                                <div class="card animated-button1">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="card-block">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home3" role="tabpanel" aria-labelledby="pills-home-tab3">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-purple">{{ currency()['symble'] }} {{ number_format(available_balance(), 2) }}</h4>
                                                        <h6 class="text-muted m-b-0">Available Balance</h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a href="#">
                                                            <i class="fa fa-file-text-o f-28"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile3" role="tabpanel" aria-labelledby="pills-profile-tab3">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-green"><strong class="">{{ number_format(available_point(), 2) }}</strong> <strong>AP</strong></h4>
                                                        <h6 class="text-muted m-b-0">Available Points</h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a href="{{ route('user.customer.reports.index') }}">
                                                            <i class="fa fa-file-text-o f-28"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-green">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link active" id="pills-home-tab3" data-toggle="pill" data-target="#pills-home3" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Amount</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link" id="pills-profile-tab3" data-toggle="pill" data-target="#pills-profile3" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Point</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-sm-12 pb-3">
                                <div class="card animated-button1">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="card-block">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-green">{{ currency()['symble'] }} <strong class="my_sales_amount">0.00</strong> <strong></strong></h4>
                                                        <h6 class="text-muted m-b-0">Total Sales Amount </h6>
                                                    </div>
                                                    
                                                    <div class="col-4 text-right">
                                                        <a href="{{ route('user.customer.order.index') }}?deliverd">
                                                            <i class="fa fa-file-text-o f-28"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-green"><strong class="my_sales_point">00</strong> <strong>AP</strong></h4>
                                                        <h6 class="text-muted m-b-0">Total Sales Point </h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a href="{{ route('user.customer.order.index') }}?deliverd">
                                                            <i class="fa fa-file-text-o f-28"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-green">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Amount</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Point</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-sm-12 pb-3">
                                <div class="card animated-button1">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="card-block">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home1" role="tabpanel" aria-labelledby="pills-home-tab1">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-blue">{{ currency()['symble'] }} <strong class="team_sales_amount">0.00</strong> <strong></strong></h4>
                                                        <h6 class="text-muted m-b-0">Total Team Sales Amount </h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <i class="fa fa-file-text-o f-28"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile-tab1">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-blue"><strong class="team_sales_point">00</strong> <strong>AP</strong></h4>
                                                        <h6 class="text-muted m-b-0">Total Team Sales Point </h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <i class="fa fa-file-text-o f-28"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-blue">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link active" id="pills-home-tab1" data-toggle="pill" data-target="#pills-home1" type="button" role="tab" aria-controls="pills-home1" aria-selected="true">Amount</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link" id="pills-profile-tab1" data-toggle="pill" data-target="#pills-profile1" type="button" role="tab" aria-controls="pills-profile1" aria-selected="false">Point</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6 col-sm-12 pb-3">
                                <div class="card animated-button1">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="card-block">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home4" role="tabpanel" aria-labelledby="pills-home-tab4">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-purple">{{ currency()['symble'] }} {{ number_format(withdraw_amount('approved'), 2) }}</h4>
                                                        <h6 class="text-muted m-b-0">Paid Withdraw</h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a href="{{ route('user.customer.withdraw.index') }}?approved_list">
                                                            <i class="fa fa-file-text-o f-28"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-profile4" role="tabpanel" aria-labelledby="pills-profile-tab4">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-green"><strong class="">{{ currency()['symble'] }} {{ number_format(withdraw_amount('pending'), 2) }}</strong></h4>
                                                        <h6 class="text-muted m-b-0">Pending Withdraw</h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a href="{{ route('user.customer.withdraw.index') }}">
                                                            <i class="fa fa-file-text-o f-28"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pills-profile44" role="tabpanel" aria-labelledby="pills-profile-tab44">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h4 class="text-c-green"><strong class="">{{ currency()['symble'] }} {{ number_format(withdraw_amount('rejected'), 2) }}</strong></h4>
                                                        <h6 class="text-muted m-b-0">Rejected Withdraw</h6>
                                                    </div>
                                                    <div class="col-4 text-right">
                                                        <a href="{{ route('user.customer.withdraw.index') }}?rejected_list">
                                                            <i class="fa fa-file-text-o f-28"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer bg-c-green">
                                        <div class="row align-items-center">
                                            <div class="col-9">
                                                <ul class="nav nav-pills" id="pills-tab" role="tablist">

                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link active" id="pills-home-tab4" data-toggle="pill" data-target="#pills-home4" type="button" role="tab" aria-controls="pills-home4" aria-selected="true">Paid</button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link" id="pills-profile-tab4" data-toggle="pill" data-target="#pills-profile4" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Pending</button>
                                                    </li>

                                                    <li class="nav-item" role="presentation">
                                                      <button style="color: #333;" class="nav-link" id="pills-profile-tab44" data-toggle="pill" data-target="#pills-profile44" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Rejected</button>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Club Bonus Details --}}
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-12 text-center p-3 text-primary">
                                <h4 class="text-c-blue">Club Bonus Details</h4>
                            </div>
                            @foreach ($club_bonus as $bonus)
                                <div class="col-xl-4 col-col-md-6">
                                    <div class="card bonus-card">
                                        <div class="card-title text-center bg-success p-2" style="border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                            <h4 class="my-0">{{ $bonus->name }}</h4>
                                        </div>
                                        <div class="card-body p-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td style="text-align: left;font-weight:600;">Rank</td>
                                                        <td style="text-align: center;font-weight:600;">Bonus</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bonus->clubBonusDetailsAsset as $item)
                                                        <tr>
                                                            <td>{{ $item->rank->name }}</td>
                                                            <td class="text-center">{{ currency()['symble'] }} {{ number_format((company_total_sell_point() * $item->bonus) / 100, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    {{-- Club Bonus Details --}}

                    <!-- task, page, download counter  end -->

                    <!--  sale analytics start -->
                    {{-- <div class="col-xl-8 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Sales Analytics</h5>
                                <span class="text-muted">Get 15% Off on <a
                                        href="https://www.amcharts.com/"
                                        target="_blank">amCharts</a> licences. Use code
                                    "codedthemes" and get the discount.</span>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="fa fa fa-wrench open-card-option"></i>
                                        </li>
                                        <li><i class="fa fa-window-maximize full-card"></i>
                                        </li>
                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                        <li><i class="fa fa-trash close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div id="sales-analytics" style="height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col">
                                        <h4>$256.23</h4>
                                        <p class="text-muted">This Month</p>
                                    </div>
                                    <div class="col-auto">
                                        <label class="label label-success">+20%</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <canvas id="this-month"
                                            style="height: 150px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card quater-card">
                            <div class="card-block">
                                <h6 class="text-muted m-b-15">This Quarter</h6>
                                <h4>$3,9452.50</h4>
                                <p class="text-muted">$3,9452.50</p>
                                <h5>87</h5>
                                <p class="text-muted">Online Revenue<span
                                        class="f-right">80%</span></p>
                                <div class="progress">
                                    <div class="progress-bar bg-c-blue" style="width: 80%">
                                    </div>
                                </div>
                                <h5 class="m-t-15">68</h5>
                                <p class="text-muted">Offline Revenue<span
                                        class="f-right">50%</span></p>
                                <div class="progress">
                                    <div class="progress-bar bg-c-green" style="width: 50%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--  sale analytics end -->

                    <!--  project and team member start -->
                    {{-- <div class="col-xl-8 col-md-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <h5>Projects</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="fa fa fa-wrench open-card-option"></i>
                                        </li>
                                        <li><i class="fa fa-window-maximize full-card"></i>
                                        </li>
                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                        <li><i class="fa fa-trash close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="chk-option">
                                                        <div
                                                            class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox"
                                                                    value="">
                                                                <span class="cr">
                                                                    <i
                                                                        class="cr-icon fa fa-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    Assigned
                                                </th>
                                                <th>Name</th>
                                                <th>Due Date</th>
                                                <th class="text-right">Priority</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="chk-option">
                                                        <div
                                                            class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox"
                                                                    value="">
                                                                <span class="cr">
                                                                    <i
                                                                        class="cr-icon fa fa-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-inline-block align-middle">
                                                        <img src="assets/images/avatar-4.jpg"
                                                            alt="user image"
                                                            class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <h6>John Deo</h6>
                                                            <p class="text-muted m-b-0">
                                                                Graphics Designer</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Able Pro</td>
                                                <td>Jun, 26</td>
                                                <td class="text-right"><label
                                                        class="label label-danger">Low</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="chk-option">
                                                        <div
                                                            class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox"
                                                                    value="">
                                                                <span class="cr">
                                                                    <i
                                                                        class="cr-icon fa fa-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-inline-block align-middle">
                                                        <img src="assets/images/avatar-5.jpg"
                                                            alt="user image"
                                                            class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <h6>Jenifer Vintage</h6>
                                                            <p class="text-muted m-b-0">Web
                                                                Designer</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Mashable</td>
                                                <td>March, 31</td>
                                                <td class="text-right"><label
                                                        class="label label-primary">high</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="chk-option">
                                                        <div
                                                            class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox"
                                                                    value="">
                                                                <span class="cr">
                                                                    <i
                                                                        class="cr-icon fa fa-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-inline-block align-middle">
                                                        <img src="assets/images/avatar-3.jpg"
                                                            alt="user image"
                                                            class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <h6>William Jem</h6>
                                                            <p class="text-muted m-b-0">
                                                                Developer</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Flatable</td>
                                                <td>Aug, 02</td>
                                                <td class="text-right"><label
                                                        class="label label-success">medium</label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="chk-option">
                                                        <div
                                                            class="checkbox-fade fade-in-primary">
                                                            <label class="check-task">
                                                                <input type="checkbox"
                                                                    value="">
                                                                <span class="cr">
                                                                    <i
                                                                        class="cr-icon fa fa-check txt-default"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="d-inline-block align-middle">
                                                        <img src="assets/images/avatar-2.jpg"
                                                            alt="user image"
                                                            class="img-radius img-40 align-top m-r-15">
                                                        <div class="d-inline-block">
                                                            <h6>David Jones</h6>
                                                            <p class="text-muted m-b-0">
                                                                Developer</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Guruable</td>
                                                <td>Sep, 22</td>
                                                <td class="text-right"><label
                                                        class="label label-primary">high</label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-right m-r-20">
                                        <a href="#!"
                                            class=" b-b-primary text-primary">View all
                                            Projects</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h5>Team Members</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="fa fa fa-wrench open-card-option"></i>
                                        </li>
                                        <li><i class="fa fa-window-maximize full-card"></i>
                                        </li>
                                        <li><i class="fa fa-minus minimize-card"></i></li>
                                        <li><i class="fa fa-refresh reload-card"></i></li>
                                        <li><i class="fa fa-trash close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="align-middle m-b-30">
                                    <img src="assets/images/avatar-2.jpg" alt="user image"
                                        class="img-radius img-40 align-top m-r-15">
                                    <div class="d-inline-block">
                                        <h6>David Jones</h6>
                                        <p class="text-muted m-b-0">Developer</p>
                                    </div>
                                </div>
                                <div class="align-middle m-b-30">
                                    <img src="assets/images/avatar-1.jpg" alt="user image"
                                        class="img-radius img-40 align-top m-r-15">
                                    <div class="d-inline-block">
                                        <h6>David Jones</h6>
                                        <p class="text-muted m-b-0">Developer</p>
                                    </div>
                                </div>
                                <div class="align-middle m-b-30">
                                    <img src="assets/images/avatar-3.jpg" alt="user image"
                                        class="img-radius img-40 align-top m-r-15">
                                    <div class="d-inline-block">
                                        <h6>David Jones</h6>
                                        <p class="text-muted m-b-0">Developer</p>
                                    </div>
                                </div>
                                <div class="align-middle m-b-30">
                                    <img src="assets/images/avatar-4.jpg" alt="user image"
                                        class="img-radius img-40 align-top m-r-15">
                                    <div class="d-inline-block">
                                        <h6>David Jones</h6>
                                        <p class="text-muted m-b-0">Developer</p>
                                    </div>
                                </div>
                                <div class="align-middle m-b-10">
                                    <img src="assets/images/avatar-5.jpg" alt="user image"
                                        class="img-radius img-40 align-top m-r-15">
                                    <div class="d-inline-block">
                                        <h6>David Jones</h6>
                                        <p class="text-muted m-b-0">Developer</p>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="#!" class="b-b-primary text-primary">View
                                        all Projects</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!--  project and team member end -->
                </div>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            getInvest();
        });

        // axios request for geting gen invest data
        function getInvest(){
            let team_sales_amount = 0;
            let team_sales_point = 0;
            // $(".tabledata").empty();

            axios.get("{{ route('user.customer.refer.team.invest') }}")
            .then(res=> {
                console.log(res);
                // html="<tr>"
                res.data.links.forEach(function(d){
                    team_sales_amount += d.deposit;
                    team_sales_point += d.point;
                    // html+='<td class="text-center">' + d.username + '</td>';
                    // html+='<td class="text-center">' + (d.deposit).toFixed(2) + '</td>';
                    // html+='<td class="text-center">' + (d.point).toFixed(2) + '</td></tr>';
                })
                // $(".tabledata").html(html);

                $('.my_sales_amount').html('')
                $('.my_sales_point').html('')
                $('.my_sales_amount').html(res.data.sales_amount.toFixed(2));
                $('.my_sales_point').html(res.data.sales_point);

                $('.team_sales_amount').html('')
                $('.team_sales_point').html('')
                $('.team_sales_amount').html(team_sales_amount.toFixed(2));
                $('.team_sales_point').html(team_sales_point);
            });
        }

    </script>
@endpush


