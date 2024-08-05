@extends('layouts.admin.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
            <form action="{{ route('admin.settings.country.update', $country->id) }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Country Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Country Name" value="{{ $country->name }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Flag <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="flag">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header mb-0 bg-info">
                            <h4 class="text-center mb-0"><strong>Country Extra Information</strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <table class="table table-bordered text-center" id="extra-info">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Value</th>
                                                <th>
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="addRow()">Add New</button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($countryExtraInfo))
                                                @forelse ($countryExtraInfo as $item)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="info_key[]" class="form-control form-control-sm" placeholder="Name" value="{{ $item->info_key }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="info_value[]" class="form-control form-control-sm" placeholder="Value" value="{{ $item->info_value }}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td>
                                                        <input type="text" name="info_key[]" class="form-control form-control-sm" placeholder="Name">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="info_value[]" class="form-control form-control-sm" placeholder="Value">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header mb-0 bg-info">
                            <h4 class="text-center mb-0"><strong>Visa</strong></h4>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered text-center" id="visa">
                                    <thead>
                                        <tr>
                                            <th>Visa Name</th>
                                            <th>Details</th>
                                            <th>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="addVisaRow()">Add New</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($countryVisa))
                                            @forelse ($countryVisa as $item)
                                            <tr>
                                                <td>
                                                    <input type="text" name="visa_name[]" class="form-control form-control-sm" placeholder="Name" value="{{ $item->visa_name }}">
                                                </td>
                                                <td>
                                                    <textarea type="number" name="description[]" class="form-control form-control-sm" placeholder="Description">{{ $item->description }}</textarea>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button>
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header mb-0 bg-info">
                            <h4 class="text-center mb-0"><strong>Documents Requirements</strong></h4>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered text-center" id="document">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Description</th>
                                            <th>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="addDocumentRow()">Add New</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($documentRequirments))
                                            @forelse ($documentRequirments as $item)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="document_name[]" class="form-control form-control-sm" placeholder="Name" value="{{ $item->document_name }}">
                                                    </td>
                                                    <td>
                                                        <textarea type="number" name="document_description[]" class="form-control form-control-sm document_description" placeholder="Description">{!! $item->document_description !!}</textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td>
                                                        <input type="text" name="document_name[]" class="form-control form-control-sm" placeholder="Name">
                                                    </td>
                                                    <td>
                                                        <textarea type="number" name="document_description[]" class="form-control form-control-sm document_description" placeholder="Description"></textarea>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header mb-0 bg-info">
                            <h4 class="text-center mb-0"><strong>Sample Documents & Photos</strong></h4>
                        </div>
                        <div class="card-body">
                                <table class="table table-bordered text-center" id="photos">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Description</th>
                                            <th>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="addPhotosRow()">Add New</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($documentPhotos))
                                            @forelse ($documentPhotos as $item)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="details[]" class="form-control form-control-sm" placeholder="Name" value="{{ $item->details }}">
                                                    </td>
                                                    <td>
                                                    <input type="file" class="form-control" name="document_photo[]">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button>
                                                    </td>
                                                </tr>
                                            @empty

                                            <tr>
                                                <td>
                                                    <input type="text" name="details[]" class="form-control form-control-sm" placeholder="Name">
                                                </td>
                                                <td>
                                                   <input type="file" class="form-control" name="document_photo[]">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button>
                                                </td>
                                            </tr>
                                            @endforelse
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="">Eligibility to Apply for Visa</label>
                                    <textarea name="eligibility_for_visa" id="summernote1" cols="30" rows="10">{!! $country->eligibility_for_visa !!}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="">Visa Fees & Service Charges</label>
                                    <textarea name="fees_charges" id="summernote2" cols="30" rows="10">{!! $country->fees_charges !!}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="">Before Departure Requirements</label>
                                    <textarea name="departure_requiremet" id="summernote3" cols="30" rows="10">{!! $country->departure_requiremet !!}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="">Processing Time</label>
                                    <textarea name="processing_time" id="summernote4" cols="30" rows="10">{!! $country->processing_time !!}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="">Important Contacts & Links</label>
                                    <textarea name="contacts_links" id="summernote5" cols="30" rows="10">{!! $country->contacts_links !!}</textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="">Remarks</label>
                                    <textarea name="remarks" id="summernote6" cols="30" rows="10">{!! $country->remarks !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-md-6">
                    <button class="btn btn-primary btn-block w-100" type="submit">UPDATE DATA</button>
                </div>
            </div>
        </form>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote1, #summernote2, #summernote3, #summernote4, #summernote5, #summernote6, .document_description').summernote();
    });
    function removeRow(button) {
            $(button).closest('tr').remove();
        }
    function addRow() {
            var newRow = $(
                '<tr>' +
                '<td><input type="text" name="info_key[]" class="form-control form-control-sm" placeholder="Name"></td>' +
                '<td><input type="text" name="info_value[]" class="form-control form-control-sm" placeholder="Value"></td>' +
                '<td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button></td>' +
                '</tr>'
            );
            $("#extra-info tbody").append(newRow);
        }
        function addVisaRow() {
            var newRow = $(
                '<tr>' +
                '<td><input type="text" name="visa_name[]" class="form-control form-control-sm" placeholder="Name"></td>' +
                '<td><textarea type="number" name="description[]" class="form-control form-control-sm" placeholder="Description"></textarea></td>' +
                '<td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button></td>' +
                '</tr>'
            );
            $("#visa tbody").append(newRow);
        }
        function addDocumentRow() {
            var newRow = $(
                '<tr>' +
                '<td><input type="text" name="document_name[]" class="form-control form-control-sm" placeholder="Name"></td>' +
                '<td><textarea type="number" name="document_description[]" class="form-control form-control-sm document_description" placeholder="Description"></textarea></td>' +
                '<td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button></td>' +
                '</tr>'
            );
            $("#document tbody").append(newRow);
            $('.document_description').last().summernote();
        }
        function addPhotosRow() {
            var newRow = $(
                '<tr>' +
                '<td><input type="text" name="details[]" class="form-control form-control-sm" placeholder="Name"></td>' +
                '<td><input type="file" class="form-control" name="document_photo[]"></td>' +
                '<td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">Delete</button></td>' +
                '</tr>'
            );
            $("#photos tbody").append(newRow);
            // $('.document_description').last().summernote();
        }
</script>

@endpush

