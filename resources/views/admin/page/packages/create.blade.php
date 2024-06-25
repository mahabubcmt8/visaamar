@extends('layouts.admin.app')
@push('css')
    <style>
        table#product-extra-info tbody tr td {
            background: #f5f5f9 !important;
            border: 1px solid #ddd !important;
            padding: 6px !important;
        }
    </style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $pageTitle ?? 'N/A' }}</h1>
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
                                    <h3 class="card-title text-light">{{ $pageTitle ?? 'N/A' }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.package.index') }}" class="btn btn-success text-right">Package List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.package.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Package Name <span class="text-danger"> *</span></label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Package Name" value="{{ old('name') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="price">Package Price <span class="text-danger"> *</span></label>
                                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Package Price" value="{{ old('price') }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="point">Package Point<span class="text-danger"> *</span></label>
                                            <input type="text" name="point" id="point" class="form-control @error('point') is-invalid @enderror" placeholder="Enter Package Point" value="{{ old('point') }}">
                                            @error('point')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-12">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="form-group mt-3">
                                                    <label for="image">Package Image<span class="text-dark">( Optional )</span></label>
                                                    <input type="file" name="image" id="image" class="form-control" placeholder="Package Image" >
                                                    @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <textarea name="description" id="description"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label for="">Status : </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status1" value="0">
                                            <label class="form-check-label text-success" for="inlineRadio1">Active</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="1">
                                            <label class="form-check-label text-danger" for="inlineRadio2">Deactive</label>
                                          </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label for="">Stock Status : </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stock_status" id="stock_status1" value="0">
                                            <label class="form-check-label text-success" for="inlineRadio1">Stock In</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stock_status" id="stock_status2" value="1">
                                            <label class="form-check-label text-danger" for="inlineRadio2">Stock Out</label>
                                          </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Add Package</button>
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
    @include('layouts.admin.all-select2')
    <script>
        jQuery(function(e) {
            'use strict';
            $(document).ready(function() {
                $('#description').summernote({height: 200});
            });
        });
        $(document).on("click", ".delete-row", function() {
            var row = $(this).closest("tr");
            var rowId = row.find("input[name='row_id']").val();
            row.remove();
        });
    </script>
@endpush
