@extends('layouts.admin.app')
@section('content')
<style>
    .login-form div.form-group .password-show-btn{
        position: absolute;
        right: 30px;
        margin-top: -29px;
        font-size: 18px;
        cursor: pointer;
        color: #333;
        transition: 0.3s;
    }

    #verify{
        position: absolute;
        right: 30px;
        margin-top: -29px;
        font-size: 16px;
        cursor: pointer;
        color: #40bb7d;
        transition: 0.3s;
    }

    .login-form div.form-group #password-show:hover, .login-form div.form-group #con-password-show:hover {
        color: #20774b;
    }
</style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $pageTitle }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-6" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.user.list') }}" class="btn btn-success text-right">User
                                        List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <form action="@if (Route::currentRouteName() == 'admin.user.create') {{ route('admin.user.store') }} @else {{ route('admin.user.update', $user->id) }} @endif " method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (Route::currentRouteName() != 'admin.user.create')
                                    @method('PUT')
                                @endif

                                <div class="login-form">
                                    @if (request()->has('agent'))
                                        <input type="hidden" name="agent" id="agent" value="agent">
                                    @else
                                        <div class="form-group">
                                            <label for="agent">Enter Agent Username <span class="text-danger">*</span></label>
                                            <input type="text" name="agent" id="agent" class="form-control text-left text-dark @error('agent') is-invalid @enderror" placeholder="Agent username" value="@if ($user != ''){{  $user->agent }}@else{{ old('agent') }}@endif">
                                            <i id="verify" class="fa fa-check agent_verify d-none"></i>
                                            <div class="agentError"></div>

                                            @error('agent')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="name">Enter Your Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name" value="@if ($user != ''){{  $user->name }}@else{{ old('name') }}@endif">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Enter Username <span class="text-danger">*</span></label>
                                        <input type="username" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Enter Username" value="@if (Route::currentRouteName() == 'admin.user.create'){{ $username }}@else @if ($user != ''){{  $user->username }}@endif @endif" @if (Route::currentRouteName() != 'admin.user.create') readonly @endif>
                                        <div class="usernameError"></div>
                                        {{-- @if ($user != ''){{  $user->username }}@else{{ old('username') }}@endif --}}
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Enter Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@mail.com" value="@if ($user != ''){{  $user->email }}@else{{ old('email') }}@endif">

                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nid_no">IC / Passport <span class="text-danger">*</span></label>
                                        <input type="nid_no" name="nid_no"  id="nid_no" class="form-control @error('nid_no') is-invalid @enderror" placeholder="1225***********54" value="@if ($user != ''){{  $user->nid_no }}@else{{ old('nid_no') }}@endif">

                                        @error('nid_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="gender">Select Gender <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="gender" name="gender">
                                                    <option value selected></option>
                                                    <option value="{{ App\Helpers\Constant::GENDER['male'] }}" @if ($user != '') @if ($user->gender == App\Helpers\Constant::GENDER['male']) selected @endif @else @if (old('gender') == App\Helpers\Constant::GENDER['male']) selected @endif @endif >Male</option>
                                                    <option value="{{ App\Helpers\Constant::GENDER['female'] }}" @if ($user != '') @if ($user->gender == App\Helpers\Constant::GENDER['female']) selected @endif @else @if (old('gender') == App\Helpers\Constant::GENDER['female']) selected @endif @endif >Female</option>
                                                    <option value="{{ App\Helpers\Constant::GENDER['others'] }}" @if ($user != '') @if ($user->gender == App\Helpers\Constant::GENDER['others']) selected @endif @else @if (old('gender') == App\Helpers\Constant::GENDER['others']) selected @endif @endif >Others</option>
                                                </select>

                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="birthday">Date Of Birth <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="birthday" name="birthday" value="@if ($user != ''){{  $user->birthday }}@else{{ old('birthday') }}@endif"  placeholder="d-m-Y">

                                                @error('birthday')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="country">Select Country <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="country" name="country">
                                                    <option value selected></option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}" @if ($user != '') @if ($country->id == $user->country) selected @endif  @else @if ($country->id == old('country')) selected @endif @endif >{{ $country->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="states">Select States <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="states" name="states">
                                                    <option value selected></option>
                                                </select>

                                                @error('states')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Enter Phone Number <span class="text-danger">*</span></label>
                                        <div class="w-100 d-inline-flex">
                                            <div style="width: 70px;">
                                                <input type="text" readonly class="text-center form-control" id="code" style="border-right: none !important; color: #000;" placeholder="+11" name="tele_code">
                                            </div>
                                            <div style="width: 100%;">
                                                <input type="text" name="phone"  id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="01XXXXXXXXX" value="@if ($user != ''){{  $user->phone }}@else{{ old('phone') }}@endif">
                                            </div>
                                        </div>

                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="refer">Enter Refer Username <span class="text-danger">*</span></label>
                                        <input type="text" name="refer" id="refer" class="form-control @error('refer') is-invalid @enderror" placeholder="Referral Username" value="@if ($user != ''){{  $user->refer }}@else{{ old('refer') }}@endif">
                                        <i id="verify" class="fa fa-check refer_verify d-none"></i>
                                        <div class="referError"></div>

                                        @error('refer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Enter Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" value="@if ($user != ''){{  $user->show_password }}@else{{ old('password') }}@endif">
                                        <span class="password-show-btn" id="password-show"><i id="password-show-icon" class="fa fa-eye"></i></span>

                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="con_password">Enter Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" id="con_password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="********" value="@if ($user != ''){{  $user->show_password }}@else{{ old('password_confirmation') }}@endif">
                                        <span class="password-show-btn" id="con-password-show"><i id="con-password-show-icon" class="fa fa-eye"></i></span>

                                        <div class="con_passwordError"></div>

                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 @if (Route::currentRouteName() == 'admin.user.create') d-none @endif">
                                            <div class="form-group">
                                                <label for="type">User Type <span class="text-danger">*</span></label>
                                                <select name="type" class="form-control @error('type') is-invalid @enderror" id="type" required>
                                                    @if (request()->has('agent'))
                                                        <option value="{{ App\Helpers\Constant::USER_TYPE['agent'] }}" @if ($user != ''){{ ($user->type == App\Helpers\Constant::USER_TYPE['agent']) ? 'selected' : ''  }}@endif>Agent</option>
                                                    @else
                                                        <option value="{{ App\Helpers\Constant::USER_TYPE['user'] }}" @if ($user != ''){{ ($user->type == App\Helpers\Constant::USER_TYPE['user']) ? 'selected' : ''  }}@endif>User</option>
                                                    @endif
                                                </select>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 @if (Route::currentRouteName() == 'admin.user.create') col-md-12 @endif">
                                            <div class="form-group">
                                                <label for="status">User Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
                                                    <option value="{{ App\Helpers\Constant::USER_STATUS['active'] }}" @if ($user != ''){{ ($user->status == App\Helpers\Constant::USER_STATUS['active']) ? 'selected' : ''  }}@endif>Active</option>

                                                    <option value="{{ App\Helpers\Constant::USER_STATUS['deactive'] }}" @if ($user != ''){{ ($user->status == App\Helpers\Constant::USER_STATUS['deactive']) ? 'selected' : ''  }}@endif>Deactive</option>

                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-success form-control" style="font-weight: 600;">
                                            @if (request()->has('agent'))
                                                @if (Route::currentRouteName() == 'admin.user.create')
                                                Add
                                                @else
                                                Update
                                                @endif
                                                Agent
                                            @else
                                                @if (Route::currentRouteName() == 'admin.user.create')
                                                Add
                                                @else
                                                Update
                                                @endif
                                                User
                                            @endif
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@push('js')
    {{-- <script>
        $("#password-show").on("click", function() {
            var passwordField = $("#password");
            var passwordIcon = $("#password-show-icon");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
            else {
                passwordField.attr("type", "password");
                passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
        $("#con-password-show").on("click", function() {
            var passwordField = $("#con_password");
            var passwordIcon = $("#con-password-show-icon");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
            else {
                passwordField.attr("type", "password");
                passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $('#username').keyup(function(){
            let username =$(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(username != ''){
                if (regex.test(username)) {
                    url = "{{ route('ajax.username.check', ':username') }}";
                    url = url.replace(':username', username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Username is available </span>';
                                $('#username').removeClass('is-invalid');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">The username has already been taken.</span>';
                                $('#username').addClass('is-invalid');
                            }
                            $('.usernameError').html(html);
                        }
                    });

                }
                else {
                    $('.usernameError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Username. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });

        $('#refer').keyup(function(){
            let refer_username =$(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(refer_username != ''){
                if (regex.test(refer_username)) {
                    url = "{{ route('ajax.referusername.check', ':refer_username') }}";
                    url = url.replace(':refer_username', refer_username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username </span>';
                                $('#refer').addClass('is-invalid');
                                $('.refer_verify').addClass('d-none');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Refer User : '+ data +' </span>';
                                $('#refer').removeClass('is-invalid');
                                $('.refer_verify').removeClass('d-none');
                            }
                            $('.referError').html(html);
                        }
                    });

                }
                else {
                    $('.referError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });

        $('#agent').keyup(function(){
            let agent_username = $(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(agent_username != ''){
                if (regex.test(agent_username)) {
                    url = "{{ route('ajax.agent_username.check', ':agent_username') }}";
                    url = url.replace(':agent_username', agent_username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Agent Username </span>';
                                $('#agent').addClass('is-invalid');
                                $('.agent_verify').addClass('d-none');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Agent User : '+ data +' </span>';
                                $('#agent').removeClass('is-invalid');
                                $('.agent_verify').removeClass('d-none');
                            }
                            $('.agentError').html(html);
                        }
                    });

                }
                else {
                    $('.agentError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Agent Username. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });

        $('#con_password').keyup(function(){
            let html = '';
            if($('#password').val() !== $('#con_password').val()){
                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">Confirm Password Not Match! </span>';
                $('#con_password').addClass('is-invalid');
            }
            else{
                html = '';
                $('#con_password').removeClass('is-invalid');
            }
            $('.con_passwordError').html(html);
        });

    </script> --}}

    @include('layouts.admin.all-select2')
    <script>

        $( function() {
            $("#birthday").datepicker({
                dateFormat: 'dd-mm-yy',
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                selectOtherMonths: true
            });
        } );
    </script>
    <script>
        $("#password-show").on("click", function() {
            var passwordField = $("#password");
            var passwordIcon = $("#password-show-icon");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
            else {
                passwordField.attr("type", "password");
                passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $("#con-password-show").on("click", function() {
            var passwordField = $("#con_password");
            var passwordIcon = $("#con-password-show-icon");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
            else {
                passwordField.attr("type", "password");
                passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $('#username').keyup(function(){
            let username =$(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(username != ''){
                if (regex.test(username)) {
                    url = "{{ route('ajax.username.check', ':username') }}";
                    url = url.replace(':username', username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Username is available </span>';
                                $('#username').removeClass('is-invalid');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">The username has already been taken.</span>';
                                $('#username').addClass('is-invalid');
                            }
                            $('.usernameError').html(html);
                        }
                    });

                }
                else {
                    $('.usernameError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Username. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });

        $('#refer').keyup(function(){
            let refer_username =$(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(refer_username != ''){
                if (regex.test(refer_username)) {
                    url = "{{ route('ajax.referusername.check', ':refer_username') }}";
                    url = url.replace(':refer_username', refer_username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username </span>';
                                $('#refer').addClass('is-invalid');
                                $('.refer_verify').addClass('d-none');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Refer User : '+ data +' </span>';
                                $('#refer').removeClass('is-invalid');
                                $('.refer_verify').removeClass('d-none');
                            }
                            $('.referError').html(html);
                        }
                    });

                }
                else {
                    $('.referError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });

        $('#agent').keyup(function(){
            let agent_username = $(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(agent_username != ''){
                if (regex.test(agent_username)) {
                    url = "{{ route('ajax.agent_username.check', ':agent_username') }}";
                    url = url.replace(':agent_username', agent_username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Agent Username </span>';
                                $('#agent').addClass('is-invalid');
                                $('.agent_verify').addClass('d-none');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Agent User : '+ data +' </span>';
                                $('#agent').removeClass('is-invalid');
                                $('.agent_verify').removeClass('d-none');
                            }
                            $('.agentError').html(html);
                        }
                    });

                }
                else {
                    $('.agentError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Agent Username. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });

        $('#con_password').keyup(function(){
            let html = '';
            if($('#password').val() !== $('#con_password').val()){
                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">Confirm Password Not Match! </span>';
                $('#con_password').addClass('is-invalid');
            }
            else{
                html = '';
                $('#con_password').removeClass('is-invalid');
            }
            $('.con_passwordError').html(html);
        });

        $('#country').change(function(){
            let country = $('#country').val();
            url = "{{ route('ajax.get.states', ':country') }}";
            url = url.replace(':country', country);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    var html = '';
                    $.each(data, function(index, value) {
                        html += '<option value="">Select</option>';
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#states').html(html);
                }
            });
        });
        $('#states').change(function(){
            let states = $('#states').val();
            url = "{{ route('ajax.get.tele_code', ':states') }}";
            url = url.replace(':states', states);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#code').val(data);
                }
            });
        });

    </script>
@endpush
