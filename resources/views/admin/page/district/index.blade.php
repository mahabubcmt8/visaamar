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
    {{--    <div class="card">--}}
    {{--        <div class="card-header border-bottom bg-primary d-flex py-3">--}}
    {{--            <div class="w-50 my-auto">--}}
    {{--                <h5 class="card-title mb-0 text-white">Best Product List</h5>--}}
    {{--            </div>--}}
    {{--            <div class="w-50 my-auto text-end">--}}
    {{--                <a href="" class=" btn btn-light px-2" style=""><i style="margin-top: -2px; margin-right: 4px;" class='bx bxs-plus-circle'></i> Add New</a>--}}
    {{--            </div>--}}

    {{--            <div class="col-6 text-right">--}}
    {{--                <a href=""   class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="card-body pt-2">--}}
    {{--            <div class="table-responsive">--}}
    {{--                <table class="table table-bordered DataTable pt-3">--}}
    {{--                    <thead>--}}
    {{--                    <tr>--}}
    {{--                        <th class="text-center" style="width: 50px;">SL</th>--}}
    {{--                        <th class="text-left">Product name</th>--}}
    {{--                        <th class="text-center" style="width: 150px;">Action</th>--}}
    {{--                    </tr>--}}
    {{--                    </thead>--}}
    {{--                    <tbody>--}}
    {{--                    @foreach($bestproducts as $bestproduct)--}}
    {{--                        <tr>--}}
    {{--                            <td>1</td>--}}
    {{--                            <td>fggd</td>--}}

    {{--                            <td>--}}
    {{--                                <a href="" class="btn btn-success btn-sm">--}}
    {{--                                    <i class="bx bx-edit"></i>--}}
    {{--                                </a>--}}
    {{--                                <a href=""   class="btn btn-danger btn-sm">--}}
    {{--                                    <i class="bx bx-trash"></i>--}}
    {{--                                </a>--}}
    {{--                            </td>--}}
    {{--                        </tr>--}}
    {{--                    @endforeach--}}
    {{--                    </tbody>--}}
    {{--                </table>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

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
                                    <a href="{{ route('admin.settings.district.create') }}"   class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                              <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
{{--                            <table class="table table-bordered table-striped DataTable" >--}}
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">SL</th>
                                    <th class="text-left">Division Name</th>
                                    <th class="text-left">District Name</th>
                                    <th class="text-left">District Bangla Name</th>
                                    <th class="text-center" style="width: 150px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($districtselect as $list)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$list->division ? $list->division->name : 'N/A'}}</td>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->bn_name}}</td>

                                    <td>
                                        <a href="{{route('admin.settings.district.edit', ['id' => $list->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('admin.settings.district.destroy', ['id' => $list->id])}}" onclick="return confirm('Are you sure to delete this ?')"  class="btn btn-danger btn-sm">
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


