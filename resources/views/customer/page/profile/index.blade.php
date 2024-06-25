@extends('layouts.customer.app')

@section('content')
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="page-body">
                <!--profile cover start-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cover-profile">
                            <div class="profile-bg-img">
                                <img class="profile-bg-img img-fluid" src="http://html.phoenixcoded.net/mega-able/files/assets/images/user-profile/bg-img1.jpg"
                                    alt="bg-img">
                                <div class="card-block user-info">
                                    <div class="col-md-12">
                                        <div class="media-left">
                                            <a href="#" class="profile-image">
                                                <img class="user-img img-radius"
                                                    src="{{ (Auth::user()->image != null) ? asset('uploads/user/profile/'.Auth::user()->image) : asset('user/assets/images/avatar-4.jpg') }}" alt="user-img">
                                            </a>
                                        </div>
                                        <div class="media-body row">
                                            <div class="col-lg-12">
                                                <div class="user-title">
                                                    <h2>{{ $user->name }}</h2>
                                                    <span class="text-white">{{ $user->username }}</span>
                                                </div>
                                            </div>
                                            {{-- <div>
                                                <div class="pull-right cover-btn">
                                                    <button type="button" class="btn btn-primary m-r-10 m-b-10"><i
                                                            class="icofont icofont-plus"></i> Follow</button>
                                                    <button type="button" class="btn btn-primary m-b-10"><i
                                                            class="icofont icofont-ui-messaging"></i> Message</button>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--profile cover end-->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- tab header start -->
                        <div class="tab-header card">
                            <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal
                                        Info</a>
                                    <div class="slide"></div>
                                </li>
                            </ul>
                        </div>
                        <!-- tab header end -->
                        <!-- tab content start -->
                        <div class="tab-content">
                            <!-- tab panel personal start -->
                            <div class="tab-pane active" id="personal" role="tabpanel">
                                <!-- personal card start -->
                                <div class="card">
                                    @if (request()->has('edit'))
                                        <div class="card-header">
                                            <h5 class="card-header-text">Edit Profile</h5>
                                            <a href="{{ route('user.customer.profile.index') }}" id="edit-btn" type="button"
                                                class="btn btn-sm btn-primary waves-effect waves-light f-right copy-btn"> View
                                            </a>
                                        </div>
                                    @else
                                        <div class="card-header">
                                            <h5 class="card-header-text">About Me</h5>
                                            <a href="{{ route('user.customer.profile.index') }}?edit" id="edit-btn" type="button"
                                                class="btn btn-sm btn-primary waves-effect waves-light f-right copy-btn">
                                                <i class="fa fa-pencil-square-o"></i> Edit
                                            </a>
                                        </div>
                                    @endif

                                    <div class="card-block">
                                        <div class="view-info">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @if (request()->has('edit'))
                                                        <form action="{{ route('user.customer.profile.update') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="username">Username <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control text-left" value="{{ $user->username }}" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">

                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">

                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                                                <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}">

                                                                @error('phone')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Profile Picture </label>
                                                                <input type="file" name="image" class="form-control  @error('phone') is-invalid @enderror" value="{{ $user->image }}">

                                                                @error('image')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group mt-3">
                                                                <button type="submit" class="btn copy-btn">Update</button>
                                                            </div>

                                                        </form>
                                                    @else
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table m-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Full Name</th>
                                                                                    <td>{{ $user->name }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Username</th>
                                                                                    <td>{{ $user->username }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Email</th>
                                                                                    <td>{{ $user->email }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Phone</th>
                                                                                    <td>{{ $user->phone }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Country</th>
                                                                                    <td>{{ $user->country }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">States</th>
                                                                                    <td>{{ $user->states }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">IC / Passport</th>
                                                                                    <td>{{ $user->nid_no }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Agent Username</th>
                                                                                    <td>{{ $user->agent }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Agent Username</th>
                                                                                    <td>{{ $user->agent }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Refer By</th>
                                                                                    <td>{{ $user->refer }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5 class="mb-3">Share Refer Link</h5>
                                                                            <div id="social-links">
                                                                                <a href="{{ $shareBtn['facebook'] }}" class="btn social-button "id=""><span class="fa fa-facebook"></span></a>

                                                                                <a href="{{ $shareBtn['whatsapp'] }}" class="btn social-button "id=""><span class="fa fa-whatsapp"></span></a>

                                                                                <a href="{{ $shareBtn['telegram'] }}" class="btn social-button "id=""><span class="fa fa-telegram"></span></a>
                                                                            </div>
                                                                            <div class="form-group mt-3">
                                                                                <input type="text" class="form-control" id="refferal" value="{{ route('login').'?refer='.$user->username }}" name="refferal" readonly>
                                                                                <button type="submit" onclick="copyToClipboard()" class="my-3 mx-1 btn btn-round btn-theme copy-btn">Copy Link</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end of table col-lg-6 -->
                                                            </div>
                                                            <!-- end of row -->
                                                        </div>
                                                    @endif
                                                    <!-- end of general info -->
                                                </div>
                                                <!-- end of col-lg-12 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of view-info -->
                                        <!-- end of edit-info -->
                                    </div>
                                    <!-- end of card-block -->
                                </div>
                                <!-- personal card end-->
                            </div>
                            <!-- tab pane personal end -->
                        </div>
                        <!-- tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function copyToClipboard() {
            var copyGfGText = document.getElementById("refferal");
            copyGfGText.select();
            document.execCommand("copy");
            success_msg('Refer Link Copid!');
        }
    </script>
@endpush
