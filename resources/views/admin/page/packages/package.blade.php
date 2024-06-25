@extends('layouts.admin.app')
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
                                    <a href="{{ route('admin.package.create') }}" class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped DataTable" >
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">SL</th>
                                        <th class="text-left">Package Details</th>
                                        <th class="text-left">Point</th>
                                        <th class="text-center" style="width: 150px;">Image</th>
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
    @include('admin.modals.view-package')
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
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'point',
                        name: 'point',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },

                    {
                        data: 'image',
                        name: 'image',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
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

        // Delete
        function destroy(id){
            var url = "{{ route('admin.package.destroy', ':id') }}";
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
                                    success_msg('Package Deleted Successfully.');
                                    $('.DataTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('Package Not Found!');
                            }
                        });
                    }
            });
        }
        function packageView(packageID){
            var url = '{{ route('admin.package.view', ':id') }}';
            url = url.replace(':id', packageID);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#modal_image').html('<img style="width: 140px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="{{ asset('uploads/package') }}/' + data.image + '" alt="">');
                    $('#modal_name').text(data.name);
                    $('#modal_price').text(data.price);
                    if (data.status == 0) {
                        $('#modal_status').html('<span class="badge badge-success">Active</span>');
                    }else{
                        $('#modal_status').html('<span class="badge badge-danger">Deactive</span>');
                    }
                    if (data.stock_status == 0) {
                        $('#modal_stock_status').html('<span class="badge badge-success">Active</span>');
                    }else{
                        $('#modal_stock_status').html('<span class="badge badge-danger">Deactive</span>');
                    }
                    $('#modal_description').html(data.description);

                    $('#viewModal').modal('show');
                }
            });
        }
    </script>
@endpush
