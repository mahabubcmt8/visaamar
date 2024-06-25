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
                                    <a href="{{route('admin.settings.upazila.create')}}"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
{{--                            <table class="table table-bordered table-striped DataTable" >--}}
                            <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">SL</th>
                                    <th class="text-left">Division Name</th>
                                    <th class="text-left">District Name</th>
                                    <th class="text-left">Upazila Name</th>
                                    <th class="text-left">Upazila Bangla Name</th>
                                    <th class="text-center" style="width: 150px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($upazilaselect as $upazilaitem)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$upazilaitem->district->division ? $upazilaitem->district->division->name : 'N/A'}}</td>
                                    <td>{{$upazilaitem->district ? $upazilaitem->district->name: 'N/A'}}</td>
                                    <td>{{$upazilaitem->name}}</td>
                                    <td>{{$upazilaitem->bn_name}}</td>
                                    <td>
                                        <a href="{{route('admin.settings.upazila.edit', ['id' => $upazilaitem->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('admin.settings.upazila.destroy', ['id' => $upazilaitem->id])}}"  onclick="return confirm('Are you sure to delerte?')"  class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#basic-datatable").DataTable()
        })
    </script>
    @endpush

