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
                                    <button type="button" id="addStateModalBtn"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table width='100%' class="table table-sm text-center" id="datatable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Postal Code</th>
                                        <th>Tele Code</th>
                                        <th>Country Name</th>
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
    @include('admin.modals.add-State')
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
                url:"{{route('admin.settings.state.index')}}"
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
                    data:'postal_code',
                    name:'postal_code',
                },
                {
                    data:'tele_code',
                    name:'tele_code',
                },
                {
                    data:'country_id',
                    name:'country_id',
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
            var url = "{{ route('admin.settings.state.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#row_id').val(data.id);
                    $('#state_name').val(data.name);
                    $('#country_id').val(data.country_id).trigger('change');
                    $('#postal_code').val(data.postal_code);
                    $('#tele_code').val(data.tele_code);

                    $('#formSubmit').addClass('d-none');
                    $('#addState').addClass('d-none');
                    $('#UpdateState').removeClass('d-none');
                    $('#addStateModal').modal('show');
                }
            });
        }

        // Category Update
        function UpdateState(){
            var data_id = $('#row_id').val();
            var state_name = $('#state_name').val();
            var country_id = $('#country_id').val();
            var postal_code = $('#postal_code').val();
            var tele_code = $('#tele_code').val();

            var formData2 = new FormData();
            formData2.append('state_name', state_name);
            formData2.append('country_id', country_id);
            formData2.append('postal_code', postal_code);
            formData2.append('tele_code', tele_code);
            formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var url = '{{ route('admin.settings.state.update', ':id') }}';
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
                    success_msg('State Update Successfully');
                    $('.state_close').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.name) {
                        $('.state_name_Error').text(errors.name);
                        $('#state_name').addClass('border-danger is-invalid');
                        $('#state_name').focus();
                        error('' + errors.name )
                    }
                    if (errors.country_id) {
                        $('.country_id_Error').text(errors.country_id);
                        $('#country_id').addClass('border-danger is-invalid');
                        $('#country_id').focus();
                        error('' + errors.country_id )
                    }
                    if (errors.postal_code) {
                        $('.postal_code_Error').text(errors.postal_code);
                        $('#postal_code').addClass('border-danger is-invalid');
                        $('#postal_code').focus();
                        error('' + errors.postal_code )
                    }
                    if (errors.tele_code) {
                        $('.tele_code_Error').text(errors.tele_code);
                        $('#tele_code').addClass('border-danger is-invalid');
                        $('#tele_code').focus();
                        error('' + errors.tele_code )
                    }
                }
            });
        }

       // Category Delete
       function destroy(id){
            var url = "{{ route('admin.settings.state.destroy', ':id') }}";
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

                                    success_msg('State Deleted Successfully.');
                                    $('#datatable').DataTable().ajax.reload();

                            },
                            error: function(){
                                warning_msg('State Not Found!');
                            }
                        });
                    }
             });
        }

    </script>
@endpush

