@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sub Categories</h1>
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
                                    <h3 class="card-title text-light">Sub Category</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" id="addSubCategoryModalBtn"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped DataTable" >
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">SL</th>
                                        <th class="text-left">Sub Category Name</th>
                                        <th class="text-left">Category Name</th>
                                        <th class="text-center" style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('admin.modals.add-subcategroy')
@endsection

@push('js')
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')
            }
        });

        $(function() {
            var dataTable;

            dataTable = $('.DataTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                dom: 'Bfrtip',
                buttons: [
                    // 'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print',
                    'reset'
                ],
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle the error, e.g., display a message or take appropriate action
                        console.error("Error: " + textStatus, errorThrown);
                    },
                },

                columns: [
                    {
                        data: 'sl',
                        name: 'sl',
                        className: 'text-center',
                        orderable: true
                    },
                    {
                        data: 'sub_category',
                        name: 'sub_category',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'category',
                        name: 'category',
                        className: 'text-left',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false
                    }

                ]

            });

        });

        $.fn.dataTable.ext.buttons.reset = {
            text: '<i class="fas fa-undo d-inline"></i> Reset' , action: function ( e, dt, node, config ) {
                dt.clear().draw();
                dt.ajax.reload();
            }
        };

        // Category Get Data For Edit
        function edit(id){
            var url = "{{ route('admin.subcategory.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#sub_category_id').val(data.id);
                    $('#category_id').val(data.category_id).trigger('change');
                    $('#sub_category_name').val(data.subcategory);

                    $('#addSubCategory').addClass('d-none');
                    $('#UpdateSubCategory').removeClass('d-none');
                    $('#addSubCategoryModal').modal('show');
                }
            });
        }

        // Category Update
        function UpdateSubCategory(){
            var data_id = $('#sub_category_id').val();
            var name = $('#sub_category_name').val();
            var category_id = $('#category_id').val();

            var formData2 = new FormData();
            formData2.append('category_id', category_id);
            formData2.append('subcategory', name);
            formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var url = '{{ route('admin.subcategory.update', ':id') }}';
            url = url.replace(':id', data_id);
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData2, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: url,
                success: function(res) {
                    SubResetForm();
                    $('#sub_category_id').val('');
                    success_msg('Sub Category Update Successfully');
                    $('.sub_category_close').click();
                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.subcategory) {
                        $('.sub_category_name_Error').text(errors.subcategory);
                        $('#sub_category_name').addClass('border-danger is-invalid');
                        $('#sub_category_name').focus();
                        error_msg(''+errors.subcategory);
                    }
                }
            });
        }

        // Category Delete
        function destroy(id){
            var url = "{{ route('admin.subcategory.destroy', ':id') }}";
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
                                if(data === 'data_have'){
                                    warning_msg('There is some data here so it cannot be deleted.');
                                }
                                else{
                                    success_msg('Sub Category Deleted Successfully.');
                                    $('.DataTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('Sub Category Not Found!');
                            }
                        });
                    }
             });
        }

    </script>
@endpush

