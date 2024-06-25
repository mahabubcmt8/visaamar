<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | {{ $pageTitle ? $pageTitle : '-' }}</title>


    @include('layouts.admin.css')
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="" height="60" width="60">
        </div> --}}

        <!-- Navbar -->
        @include('layouts.admin.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('layouts.admin.footer')
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('layouts.admin.script')

    @stack('js')
</body>

</html>


{{-- <form method="POST" action="{{ route('admin.logout') }}">
    @csrf

    <a type="button" href="{{ route('admin.logout') }}"onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</a>
</form> --}}

