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
                                    <h3 class="card-title text-light">{{ $pageTitle ?? 'N/A' }} || ID : {{ $package->id }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.package.index') }}" class="btn btn-success text-right">Package List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.package.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="name">Package Name <span class="text-danger"> *</span></label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Package Name" value="{{ $package->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="price">Package Price <span class="text-danger"> *</span></label>
                                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Package Price" value="{{ $package->price }}">
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
                                            <input type="text" name="point" id="point" class="form-control @error('point') is-invalid @enderror" placeholder="Enter Package Point" value="{{ $package->point }}">
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
                                                @if ($package->image != null)
                                                <div class="image">
                                                    <div class="uploaded-img"  style="min-height: 50px; vertical-align: middle;">
                                                        <img style="min-height: 50px" src="{{ asset('uploads/package').'/'.$package->image }}" alt="">
                                                        <span class="img-remove" onclick="packageImageRemove('{{ $package->id }}', 'image');">x</span>
                                                    </div>
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <textarea name="description" id="description">{{ $package->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label for="">Status : </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" @if($package->status == 0) checked @endif type="radio" name="status" id="status1" value="0">
                                            <label class="form-check-label text-success" for="inlineRadio1">Active</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="1"  @if($package->status == 1) checked @endif>
                                            <label class="form-check-label text-danger" for="inlineRadio2">Deactive</label>
                                          </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label for="">Stock Status : </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stock_status" id="stock_status1" value="0"  @if($package->stock_status == 0) checked @endif>
                                            <label class="form-check-label text-success" for="inlineRadio1">Stock In</label>
                                          </div>
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="stock_status" id="stock_status2" value="1"   @if($package->stock_status == 1) checked @endif>
                                            <label class="form-check-label text-danger" for="inlineRadio2">Stock Out</label>
                                          </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update Product</button>
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




        function packageImageRemove(id, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this featured Image?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('admin.package.image.remove', ':id') }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+class_name).html('');
                        }
                    });

                }
            });
        }
    </script>
@endpush
