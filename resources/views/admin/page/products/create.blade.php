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
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-success text-right">Product
                                        List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Property Title <span class="text-danger"> *</span></label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter Product Title" value="{{ old('title') }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-none">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="slug">Property Slug <span class="text-danger"> *</span></label>
                                            <input type="text" name="slug" id="slug"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                placeholder="Enter Product Slug" value="{{ old('slug') }}" readonly>
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="sub_title">Property sub Title <span class="text-danger">
                                                    *</span></label>
                                            <input type="text" name="sub_title" id="sub_title"
                                                class="form-control @error('sub_title') is-invalid @enderror"
                                                placeholder="Enter Product Sub Title" value="{{ old('sub_title') }}">
                                            @error('sub_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="row"> --}}
                                {{--                                    <div class="col-12"> --}}
                                {{--                                        <div class="form-group mt-2"> --}}
                                {{--                                            <label for="sub_title">Property Youtube Link <span class="text-danger"> *</span></label> --}}
                                {{--                                            <input type="text" name="sub_title" id="sub_title" class="form-control  is-invalid " placeholder="Enter Product Sub Title" value=""> --}}
                                {{--                                      --}}
                                {{--                                            <span class="text-danger"></span> --}}
                                {{--                                   --}}
                                {{--                                        </div> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-4">
                                            <label for="address_title">Division <span class="text-dark">( Optional
                                                    )</span></label>
                                            <select name="division_id" id="division_id" class="form-control select2">
                                                <option value=""> -- Select Division -- </option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-4">
                                            <label for="address_title">District <span class="text-dark">
                                                    (Optional)</span></label>
                                            <select name="district_id" class="form-control select2" id="districtId">
                                                <option value=""> -- Select District -- </option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-4">
                                            <label for="address_title">Thana <span class="text-dark"> (Optional)
                                                </span></label>
                                            <select name="upazila_id" class="form-control select2" id="upazilaId">
                                                <option value=""> -- Select Upazila -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="sub_title">Address <span class="text-dark"> (Optional) </span></label>
                                        <textarea class="form-control" id="address" name="address" placeholder="Enter your Address"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="sub_title">Youtube Link <span class="text-dark"> (Optional)
                                            </span></label>
                                        <input class="form-control" id="youtube" name="youtube"
                                            placeholder="Enter your youtube link">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-4" style="display: none">
                                        <div class="form-group mt-2">
                                            <label for="point">Property Point <span class="text-danger"> ( Default
                                                    Point is 0 (zero) ) </span></label>
                                            <input type="number" name="point" id="point"
                                                class="form-control @error('point') is-invalid @enderror"
                                                placeholder="Product Point" value="{{ old('point') }}">
                                            @error('point')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mt-2">
                                            <label for="price">Original Price <span class="text-danger"> *
                                                </span></label>
                                            <input type="text" name="price" id="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Product Original Price" value="{{ old('price') }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4 d-none">
                                        <div class="form-group mt-2 ">
                                            <label for="price">Offer Price </label>
                                            <input type="text" name="offer_price" id="offer_price"
                                                class="form-control @error('offer_price') is-invalid @enderror"
                                                placeholder="Product Offer Price" value="{{ old('offer_price') }}">
                                            @error('offer_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mt-2 ">
                                            <label for="price">Property Size </label>
                                            <input type="text" name="property_size" id="property_size"
                                                   class="form-control @error('property_size') is-invalid @enderror"
                                                   placeholder="Property Size" value="{{ old('property_size') }}">
                                            @error('property_size')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-3">
                                                    <label for="category_id">Property Categoy <span class="text-danger"> *
                                                        </span></label>
                                                    <select name="category_id" id="category_id"
                                                        class="form-control select2"></select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="subcategory_id">Property Sub Categoy <span
                                                            class="text-dark">( Optional )</span></label>
                                                    <select name="subcategory_id" id="subcategory_id"
                                                        class="form-control select2"></select>
                                                    @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-2 mb-0 pb-1 border-bottom">
                                                    <label for="">Property Extra Information <span
                                                            class="text-dark">( Optional )</span></label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                {{-- <div class="form-group w-100" style="border: 1px solid #a3afbb; border-radius: 4px; padding: 4px;">
                                                    <div style="width: 40px;" class="text-center">1</div>
                                                    <div class="text-center">1</div>
                                                    <div style="width: 40px;" class="text-center">1</div>
                                                </div> --}}
                                                <table class="table table-borderd" id="product-extra-info">
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="addInfo();">Add New</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-3">
                                                    <label for="thumbnail">Product Thumbnail <span
                                                            class="text-danger">*</span></label>
                                                    <input type="file" name="thumbnail" id="thumbnail"
                                                        class="form-control" placeholder="Product Thumbnail">
                                                    @error('thumbnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="featured_image">Product Featured Images<span
                                                            class="text-dark">( Optional )</span></label>
                                                    <input type="file" name="featured_image[]" id="featured_image"
                                                        class="form-control" placeholder="Product Thumbnail" multiple>
                                                    @error('featured_image')
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
                                    <div class="col-12 mt-3">
                                        <div class="form-group mt-2 ">
                                            <label for="price">Google Map</label>
                                            <input type="text" name="google_map" id="google_map"
                                                   class="form-control @error('google_map') is-invalid @enderror"
                                                   placeholder="Google Map" value="{{ old('google_map') }}">
                                            @error('google_map')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 d-none">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" name="policy" type="checkbox"
                                                id="privacy_policy" />
                                            <label class="form-check-label" for="privacy_policy">Privacy Policy</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-1 d-none">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" name="terms" type="checkbox"
                                                id="terms" />
                                            <label class="form-check-label" for="terms">Terms Of Service</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Add Property List</button>
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
                $('#description').summernote({
                    height: 200
                });
            });
        });

        $('#division_id').change(function() {
            let id = $('#division_id').val();
            let url = "{{ route('ajax.get.district.by.division', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    var option = '';
                    option += '<option value=""> -- Select District -- </option>';
                    $.each(response, function(key, value) {
                        option += '<option value="' + value.id + '"> ' + value.name +
                            ' </option>';
                    });
                    $('#districtId').empty().append(option);
                }
            });
        });
        $('#districtId').change(function() {
            let id = $('#districtId').val();
            let url = "{{ route('ajax.get.upazila.by.district', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function(response) {
                    var option = '';
                    option += '<option value=""> -- Select Upazila -- </option>';
                    $.each(response, function(key, value) {
                        option += '<option value="' + value.id + '"> ' + value.name +
                            ' </option>';
                    });
                    $('#upazilaId').empty().append(option);
                }
            });
        });



        $(document).ready(function() {
            category();
        });
        $('#category_id').change(function() {
            var cat_id = $('#category_id').val();
            sub_category(cat_id);
        });


        // Slug Making
        $('#title').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
        });

        $(document).on("click", ".delete-row", function() {
            var row = $(this).closest("tr");
            var rowId = row.find("input[name='row_id']").val();
            row.remove();
        });

        function addInfo() {
            var rowCount = $("#product-extra-info tbody tr").length + 1; // initial row index number
            var newRow = $(
                '<tr>' +

                '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_title" placeholder="Info Title" name="info_title[]"></td>' +

                '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_details" placeholder="Info Details" name="info_details[]"></td>' +

                '<td class="text-center" style="width: 40px;"><input type="hidden" name="row_id[]" value="' + rowCount +
                '"><button type="button" class="btn btn-sm btn-danger p-1 px-2 delete-row">X</button></td>' +

                '</tr>'
            );
            $("#product-extra-info tbody").append(newRow);
        }
    </script>
@endpush
