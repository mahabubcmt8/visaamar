<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
<!-- waves.css -->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('user/assets/pages/waves/css/waves.min.css') }}">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/bootstrap/css/bootstrap.min.css') }}">
<!-- themify icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/icon/themify-icons/themify-icons.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/icon/font-awesome/css/font-awesome.min.css') }}">
<!-- scrollbar.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/jquery.mCustomScrollbar.css') }}">
<!-- am chart export.css -->
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/style.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.2/sweetalert2.min.css" integrity="sha512-l1vPIxNzx1pUOKdZEe4kEnWCBzFVVYX5QziGS7zRZE4Gi5ykXrfvUgnSBttDbs0kXe2L06m9+51eadS+Bg6a+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


<style>
    a{
        color: #333;
        transition: 0.3s;
    }
    a:hover{
        color: #8CC441;
        transition: 0.3s;
    }
    .pcoded .pcoded-header[header-theme="theme1"] {
        background: #ffffff;
        border-bottom: 1px solid #8CC441;
    }
    .pcoded .pcoded-header[header-theme="theme1"] .input-group-addon, .pcoded .pcoded-header[header-theme="theme1"] a{
        color: #8CC441;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item > li.active > a{
        background: #8CC441;
    }
    .pcoded .pcoded-navbar .pcoded-navigation-label[menu-title-theme="theme1"]{
        color: #8CC441;
    }
    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li:hover > a{
        color: #8CC441 !important;
    }
    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li:hover > a i{
        color: #8CC441 !important;
    }
    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item > li.active:hover > a{
        color: #fff !important;
    }


    input, select {
        height: 42px;
    }
    input.form-control {
        border: 1px solid #70AB43 !important;
    }
    .form-control:disabled, .form-control[readonly] {
        background: transparent;
        text-align: center;
        color: #70AB43;
        font-weight: 500;
    }
    .form-group label {
        color: #333;
        font-weight: 500;
    }
    .table > thead > tr > th {
        padding: 10px 5px;
        background: #e4e8ea;
    }
    table.dataTable td, table.dataTable th {
        vertical-align: middle;
    }

    .table td, .table th{
        padding: 10px 5px;
    }

    div#social-links ul li {
        font-size: 25px;
        background: linear-gradient(135deg, #70AB43 0%,#70AB43 100%);
        margin-right: 3px;
        padding: 12px;
        border-radius: 50px;
    }

    div#social-links ul {
        display: flex;
    }

    div#social-links ul li a span {
        font-size: 15px !important;
    }

    div#social-links ul li a svg {
        font-size: 24px;
        color: #fff;
    }

    .social-button {
        border: 1px solid #70AB43;
        background: linear-gradient(135deg, #70AB43 0%,#70AB43 100%);
        padding: 9px 12px;
        text-align: center;
        vertical-align: middle;
        margin: auto;
        border-radius: 4px;
        transition: 0.5s;
    }

    .social-button span {
        font-size: 20px;
        color: #fff;
        transition: 0.5s;
    }
    .social-button:hover {
        background: #fff;
        transition: 0.5s;
    }
    .social-button:hover span {
        color: #70AB43;
        transition: 0.5s;
    }

    .copy-btn, .btn-primary{
        border: 1px solid #70AB43;
        background: linear-gradient(135deg, #70AB43 0%,#70AB43 100%);
        color: #fff;
        transition: 0.3s;
    }
    .copy-btn:hover, .btn-primary:hover{
        background: #fff;
        color: #70AB43;
        border: 1px solid #70AB43;
        transition: 0.5s;
    }
    .bg-c-purple, .bg-c-red, .bg-c-green, .bg-c-blue, .bg-c-purple, .bg-c-red, .bg-c-green, .bg-c-blue, .bg-success {
        background: #84b63f !important;
    }
    .text-c-purple, .text-c-red, .text-c-green, .text-c-blue {
        color: #84b63f;
    }
    .card .card-header h5:after{
        background-color: #8fc149;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li .pcoded-submenu li.active > a, .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li .pcoded-submenu li:hover > a{
        color: #80b13e !important;
    }
    /* .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li:hover > a i{
        color: #fff !important;
    } */

    .pcoded[fream-type="theme1"] .page-header:before, .pcoded[fream-type="theme1"] .main-menu .main-menu-header:before {
        background: rgb(132 182 63 / 72%);
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgb(132 182 63 / 44%);
        box-shadow: 0 1px 20px 0 rgb(132 182 63 / 44%);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }




</style>

@include('layouts.frontend.animated')
