@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Division</h1>
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
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('admin.settings.district.update', ['id' => $districtitem->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Division</label>
                                            <div class="cl-12">
                                                <select class="form-group select2" name="division_id" style="width: 100%;">
                                                    <option value="">-- Select Division --</option>
                                                    @foreach($divisionitem as $divisionitm)
                                                        <option value="{{$divisionitm->id}}" {{$divisionitm->id == $districtitem->division_id ? 'selected' : ''}}>{{$divisionitm->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">District</label>
                                            <input type="text" name="name" value="{{$districtitem->name}}" class="form-control" placeholder="Enter Product Name">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">District Bangla</label>
                                            <input type="text" name="bn_name" value="{{$districtitem->bn_name}}" class="form-control" placeholder="Enter Product Name">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update Now</button>
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
@endsection

