@extends('layouts.user.app')

@section('content')
<style>
    .login-form div.form-group .password-show-btn{
        position: absolute;
        right: 30px;
        margin-top: -35px;
        font-size: 18px;
        cursor: pointer;
        color: #333;
        transition: 0.3s;
    }

    #verify{
        position: absolute;
        right: 30px;
        margin-top: -28px;
        font-size: 16px;
        cursor: pointer;
        color: #40bb7d;
        transition: 0.3s;
    }

    .login-form div.form-group #password-show:hover, .login-form div.form-group #con-password-show:hover {
        color: #20774b;
    }
    select.form-control, select.form-control:focus, select.form-control:hover{
        border: 1px solid #20774b;
    }
</style>
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header card-title align-middle">
                    <div class="d-flex">
                        <h5 class="">{{ $pageTitle }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.client.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="login-form">

                            <div class="form-group">
                                <label for="agent">Enter Agent Username <span class="text-danger">*</span></label>
                                <input type="text" name="agent" id="agent" class="form-control text-left text-dark @error('agent') is-invalid @enderror" placeholder="Agent username" value="{{ auth()->user()->username }}" readonly>
                                <i id="verify" class="fa fa-check agent_verify d-none"></i>
                                <div class="agentError"></div>

                                @error('agent')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Enter Your Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name" value="{{ old('name') }}">

                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="username">Enter Username <span class="text-danger">*</span></label>
                                <input type="username" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="Enter Username" value="{{ $username }}">
                                <div class="usernameError"></div>

                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Enter Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@mail.com" value="{{ old('email') }}">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nid_no">IC / Passport <span class="text-danger">*</span></label>
                                <input type="nid_no" name="nid_no"  id="nid_no" class="form-control @error('nid_no') is-invalid @enderror" placeholder="1225***********54" value="{{ old('nid_no') }}">

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
                                            <option value="{{ App\Helpers\Constant::GENDER['male'] }}" @if (old('gender') == App\Helpers\Constant::GENDER['male']) selected @endif >Male</option>
                                            <option value="{{ App\Helpers\Constant::GENDER['female'] }}" @if (old('gender') == App\Helpers\Constant::GENDER['female']) selected @endif >Female</option>
                                            <option value="{{ App\Helpers\Constant::GENDER['others'] }}" @if (old('gender') == App\Helpers\Constant::GENDER['others']) selected @endif >Others</option>
                                        </select>

                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="birthday">Date Of Birth <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="birthday" name="birthday" value="{{ old('birthday') }}"  placeholder="d-m-Y">

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
                                                <option value="{{ $country->id }}" @if ($country->id == old('country')) selected @endif >{{ $country->name }}</option>
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
                                        <input type="number" name="phone"  id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="01XXXXXXXXX" value="{{ old('phone') }}">
                                    </div>
                                </div>

                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="refer">Enter Refer Username <span class="text-danger">*</span></label>
                                <input type="text" name="refer" id="refer" class="form-control @error('refer') is-invalid @enderror" placeholder="Referral Username" value="{{ old('refer') }}">
                                <i id="verify" class="fa fa-check refer_verify d-none"></i>
                                <div class="referError"></div>

                                @error('refer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Enter Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" value="{{ old('password') }}">
                                <span class="password-show-btn" id="password-show"><i id="password-show-icon" class="fa fa-eye"></i></span>

                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="con_password">Enter Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="con_password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="********" value="{{ old('password_confirmation') }}">
                                <span class="password-show-btn" id="con-password-show"><i id="con-password-show-icon" class="fa fa-eye"></i></span>

                                <div class="con_passwordError"></div>

                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="terms_condition" style="position: absolute; margin-top: -10px; margin-left: 0px;" required>
                                    <label class="form-check-label" for="terms_condition">I Agree with <a href="#">Terms and Conditions</a></label>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-success form-control" style="font-weight: 600;">Add User</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
