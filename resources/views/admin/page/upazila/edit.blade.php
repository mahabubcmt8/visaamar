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
                                    <h3 class="card-title text-light">Upazial</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('admin.settings.upazila.update', ['id' => $dataupozila->id])}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Division</label>
                                            <select class=" form-control select2"  name="division_id" style="width: 100%;">
                                                <option value="">-- Select Division --</option>
                                                @foreach($divisions as $item)
                                                    <option value="{{$item->id}}" {{ ($item->id == $dataupozila->district->division_id) ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="title">Division</label>
                                            <select class=" form-control select2"  name="district_id" style="width: 100%;">
                                                <option value="">-- Select District --</option>
                                                @foreach($districts as $item)
                                                    <option value="{{$item->id}}" {{ ($item->id == $dataupozila->district_id) ? 'selected' : ''}}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Upzila</label>
                                            <input type="text" name="name" value="{{$dataupozila->name}}" class="form-control" placeholder="Enter Upazila Name">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Bangla Upzila</label>
                                            <input type="text" name="bn_name" value="{{$dataupozila->bn_name}}" class="form-control" placeholder="Enter Upazila Name">
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


