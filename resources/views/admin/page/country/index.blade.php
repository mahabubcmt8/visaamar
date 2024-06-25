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

                            <div class="row">
                                <div class="col-6" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" id="addCountryModalBtn"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table width='100%' class="table table-sm text-center" id="datatable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>C. Name</th>
                                        <th>Currency Name</th>
                                        <th>Currency Symbol</th>
                                        <th>Time Zone</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('admin.modals.add-Country')
@endsection

@push('js')
    <script>
    var datatable;
        $(document).ready(function(){
            datatable= $('#datatable').DataTable({
                processing:true,
                serverSide:true,
                responsive:true,
                ajax:{
                url:"{{route('admin.settings.country.index')}}"
                },
                columns:[
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    orderable:false,
                    searchable:false
                },
                {
                    data:'name',
                    name:'name',
                },
                {
                    data:'currency_name',
                    name:'currency_name',
                },
                {
                    data:'currency_symbol',
                    name:'currency_symbol',
                },
                {
                    data:'timezone',
                    name:'timezone',
                },
                {
                    data:'action',
                    name:'action',
                    className: 'text-center'
                }
                ]
            });
        })
           // Category Get Data For Edit
        function edit(id){
            var url = "{{ route('admin.settings.country.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#row_id').val(data.id);
                    $('#country_name').val(data.name);
                    $('#currency_name').val(data.currency_name);
                    $('#currency_symbol').val(data.currency_symbol);
                    $('#timezone').val(data.timezone).trigger('change');

                    $('#formSubmit').addClass('d-none');
                    $('#addCountry').addClass('d-none');
                    $('#UpdateCountry').removeClass('d-none');
                    $('#addCountryModal').modal('show');
                }
            });
        }

        // Category Update
        function UpdateCountry(){
            var data_id = $('#row_id').val();
            var country_name = $('#country_name').val();
            var currency_name = $('#currency_name').val();
            var currency_symbol = $('#currency_symbol').val();
            var timezone = $('#timezone').val();

            var formData2 = new FormData();
            formData2.append('country_name', country_name);
            formData2.append('currency_name', currency_name);
            formData2.append('currency_symbol', currency_symbol);
            formData2.append('timezone', timezone);
            formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var url = '{{ route('admin.settings.country.update', ':id') }}';
            url = url.replace(':id', data_id);
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData2, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: url,
                success: function(res) {
                    resetForm();
                    $('#row_id').val('');
                    success_msg('Country Update Successfully');
                    $('.country_close').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.country_name) {
                        $('.country_name_Error').text(errors.country_name);
                        $('#country_name').addClass('border-danger is-invalid');
                        $('#country_name').focus();
                        error('' + errors.country_name )
                    }
                    if (errors.currency_name) {
                        $('.currency_name_Error').text(errors.currency_name);
                        $('#currency_name').addClass('border-danger is-invalid');
                        $('#currency_name').focus();
                        error('' + errors.currency_name )
                    }
                    if (errors.currency_symbol) {
                        $('.currency_symbol_Error').text(errors.currency_symbol);
                        $('#currency_symbol').addClass('border-danger is-invalid');
                        $('#currency_symbol').focus();
                        error('' + errors.currency_symbol )
                    }
                    if (errors.timezone) {
                        $('.timezone_Error').text(errors.timezone);
                        $('#timezone').addClass('border-danger is-invalid');
                        $('#timezone').focus();
                        error('' + errors.timezone )
                    }
                }
            });
        }

       // Category Delete
       function destroy(id){
            var url = "{{ route('admin.settings.country.destroy', ':id') }}";
            url = url.replace(':id', id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {

                                    success_msg('Country Deleted Successfully.');
                                    $('#datatable').DataTable().ajax.reload();

                            },
                            error: function(){
                                warning_msg('Country Not Found!');
                            }
                        });
                    }
             });
        }

    </script>
@endpush

