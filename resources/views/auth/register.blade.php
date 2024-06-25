{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ayur Grean | User Register </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Ayur Grean" />
    <meta name="keywords"
        content="Ayur Grean" />
    <meta name="author" content="AyurGrean" />
    <!-- Favicon icon -->

    <link rel="icon" href="{{ asset('user/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/bootstrap/css/bootstrap.min.css') }}">
    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('user/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/icon/icofont/css/icofont.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/style.css') }}">
</head>

<body themebg-pattern="theme1">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->

                    <form class="md-float-material form-material" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="text-center">
                            <img src="{{ asset('uploads/system/').'/'.companyInfo()->website_logo }}" width="100" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Register Now</h3>
                                    </div>
                                </div>
                                @error('name')
                                    <div class="alert alert-danger w-100 text-center " style="background-color: #e92e401f; border-color: #e92e401f; color: #ff000f;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('email')
                                    <div class="alert alert-danger w-100 text-center " style="background-color: #e92e401f; border-color: #e92e401f; color: #ff000f;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('password')
                                    <div class="alert alert-danger w-100 text-center " style="background-color: #e92e401f; border-color: #e92e401f; color: #ff000f;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('password_confirmation')
                                    <div class="alert alert-danger w-100 text-center " style="background-color: #e92e401f; border-color: #e92e401f; color: #ff000f;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group form-primary">
                                            <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" style="border: 1px solid #ddd; border-radius: 4px !important; padding: 1px 6px !important;"/>
                                            <span class="form-bar"></span>
                                            <label class="float-label" for="name">Enter Your Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="form-group form-primary">
                                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" style="border: 1px solid #ddd; border-radius: 4px !important; padding: 1px 6px !important;"/>
                                            <span class="form-bar"></span>
                                            <label class="float-label" for="email">Enter Your Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="form-group form-primary">
                                            <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password" style="border: 1px solid #ddd; border-radius: 4px !important; padding: 1px 6px !important;"/>
                                            <span class="form-bar"></span>
                                            <label class="float-label" for="password">Enter Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="form-group form-primary">
                                            <input class="form-control" type="password" id="password_confirmation"
                                            name="password_confirmation" required autocomplete="new-password" style="border: 1px solid #ddd; border-radius: 4px !important; padding: 1px 6px !important;"/>
                                            <span class="form-bar"></span>
                                            <label class="float-label" for="password_confirmation">Confirm Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">{{ __('Register') }}</button>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group form-primary text-center">
                                            <a href="{{ route('login') }}" class="text-center"> {{ __('Already registered?') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>


    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('user/assets/js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/assets/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- waves js -->
    <script src="{{ asset('user/assets/pages/waves/js/waves.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('user/assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('user/assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('user/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="{{ asset('user/bower_components/i18next/js/i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('user/assets/js/common-pages.js') }}"></script>
</body>

</html>

