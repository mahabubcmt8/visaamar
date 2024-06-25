@extends('layouts.admin.app')
@section('content')
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
                            <h3 class="card-title">{{$pageTitle }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="text-center text-success">{{Session::get('message')}}</p>
                            <form method="POST" action="{{ route('admin.settings.contact.update', $data->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <lablel for="about">Address</lablel>
                                    <textarea rows="3" name="address" class="form-control" placeholder="Inter your Address" id="description">{{$data->address}}</textarea>
                                </div>
                                <div class="form-group">
                                    <lablel for="about">Phone</lablel>
                                    <input class="form-control" value="{{$data->phone}}" id="" name="phone" placeholder="Inter your Phone Number" type="number">
                                </div>
                                <div class="form-group">
                                    <lablel for="about">Email</lablel>
                                    <input type="text" name="email" class="form-control" value="{{$data->email}}" placeholder="Inter your Email Address">
                                </div>
                                <div class="form-group">
                                    <lablel for="about">facebook</lablel>
                                    <input type="text" name="facebook" class="form-control" value="{{$data->facebook}}" placeholder="Inter your Email Address">
                                </div>
                                <div class="form-group">
                                    <lablel for="about">Instagram</lablel>
                                    <input type="text" name="Instagram" class="form-control" value="{{$data->Instagram}}" placeholder="Inter your Email Address">
                                </div>
                                <div class="form-group">
                                    <lablel for="about">LinkedIn</lablel>
                                    <input type="text" name="LinkedIn" class="form-control" value="{{$data->LinkedIn}}" placeholder="Inter your Email Address">
                                </div>
                                <div class="form-group">
                                    <lablel for="about">Twitter</lablel>
                                    <input type="text" name="twitter" class="form-control" value="{{$data->twitter}}" placeholder="Inter your Email Address">
                                </div>
                                <div class="form-group">
                                    <lablel for="about">Blogger</lablel>
                                    <input type="text" name="Blogger" class="form-control" value="{{$data->Blogger}}" placeholder="Inter your Email Address">

                                </div>
                                <div class="form-group">
                                    <lablel for="about">WhatsApp</lablel>
                                    <input type="text" name="WhatsApp" class="form-control" value="{{$data->WhatsApp}}"  placeholder="Inter your Email Address">
                                </div>
                                <div class="form-group">
                                    <lablel for="about">Contact Image</lablel>
                                    <input type="file" class="form-control" name="image" id="image">
                                    <img src="{{asset($data->image)}}" alt="" height="100" width="150">

                                <inpu type="hidden" name="idd" value=""></inpu>
                                <div class="form-group pt-3 text-right">
                                    <button type="submit" class="btn btn-success">Store</button>
                                </div>
                                {{--                                <div class="form-group pt-3 text-right">--}}
                                {{--                                <a href="{{route('admin.settings.about.update', $data->id)}}" onclick="return confirm('Are you sure to update this?')" class="btn btn-success btn-sm">Update--}}
                                {{--                                </a>--}}
                                {{--                                </div>--}}
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

{{--@push('js')--}}
{{--    <script>--}}
{{--        jQuery(function(e) {--}}
{{--            'use strict';--}}
{{--            $(document).ready(function() {--}}
{{--                $('#description').summernote({height: 200});--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}

