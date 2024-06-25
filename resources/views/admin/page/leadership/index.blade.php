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
                                    <button type="button" id="addLeadershipModalBtn"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped DataTable" >
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">SL</th>
                                        <th class="text-center">Rank</th>
                                        <th class="text-center">Lavel 1</th>
                                        <th class="text-center">Lavel 2</th>
                                        <th class="text-center">Lavel 3</th>
                                        <th class="text-center">Lavel 4</th>
                                        <th class="text-center">Lavel 5</th>
                                        <th class="text-center">Lavel 6</th>
                                        <th class="text-center">Lavel 7</th>
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
    @include('admin.modals.add-Leadership')
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
                        data: 'rank',
                        name: 'rank',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'lavel_1',
                        name: 'lavel_1',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'lavel_2',
                        name: 'lavel_2',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'lavel_3',
                        name: 'lavel_3',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'lavel_4',
                        name: 'lavel_4',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'lavel_5',
                        name: 'lavel_5',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'lavel_6',
                        name: 'lavel_6',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'lavel_7',
                        name: 'lavel_7',
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

        // // Category Get Data For Edit
        // function edit(id){
        //     var url = "{{ route('admin.leadership.edit', ':id') }}";
        //     url = url.replace(':id', id);
        //     $.ajax({
        //         type: "GET",
        //         url: url,
        //         success: function(data) {
        //             $('#Leadership_id').val(data.id);
        //             $('#name').val(data.name);
        //             $('#ap').val(data.ap);
        //             $('#group_sales').val(data.group_sales);
        //             $('#commission').val(data.commission);

        //             $('#addLeadership').addClass('d-none');
        //             $('#UpdateLeadership').removeClass('d-none');
        //             $('#addLeadershipModal').modal('show');
        //         }
        //     });
        // }

        // // Category Update
        // function UpdateLeadership(){
        //     var data_id = $('#Leadership_id').val();
        //     var name = $('#name').val();
        //     var ap = $('#ap').val();
        //     var group_sales = $('#group_sales').val();
        //     var commission = $('#commission').val();

        //     var formData2 = new FormData();
        //     formData2.append('id', data_id);
        //     formData2.append('name', name);
        //     formData2.append('ap', ap);
        //     formData2.append('group_sales', group_sales);
        //     formData2.append('commission', commission);
        //     formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

        //     var url = '{{ route('admin.leadership.update', ':id') }}';
        //     url = url.replace(':id', data_id);
        //     $.ajax({
        //         type: "POST",
        //         dataType: "json",
        //         data: formData2, // Use FormData for files
        //         contentType: false,
        //         processData: false, // Important when using FormData
        //         url: url,
        //         success: function(res) {
        //             resetForm();
        //             $('#Leadership_id').val('');
        //             success_msg('Leadership Update Successfully');
        //             $('.Leadership_close').click();
        //             $('.DataTable').DataTable().ajax.reload();
        //         },
        //         error: function(error) {
        //             var errors = error.responseJSON.errors;
        //             if (errors.commission) {
        //                 $('.commissionError').text(errors.commission);
        //                 $('#commission').addClass('border-danger is-invalid');
        //                 $('#commission').focus();
        //                 error('' + errors.commission )
        //             }
        //             if (errors.group_sales) {
        //                 $('.group_salesError').text(errors.group_sales);
        //                 $('#group_sales').addClass('border-danger is-invalid');
        //                 $('#group_sales').focus();
        //                 error('' + errors.group_sales )
        //             }
        //             if (errors.ap) {
        //                 $('.apError').text(errors.ap);
        //                 $('#ap').addClass('border-danger is-invalid');
        //                 $('#ap').focus();
        //                 error('' + errors.ap )
        //             }
        //             if (errors.name) {
        //                 $('.nameError').text(errors.name);
        //                 $('#name').addClass('border-danger is-invalid');
        //                 $('#name').focus();
        //                 error('' + errors.name )
        //             }
        //         }
        //     });
        // }

        // Category Delete
        function destroy(id){
            var url = "{{ route('admin.leadership.destroy', ':id') }}";
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
                                    success_msg('Leadership Deleted Successfully.');
                                    $('.DataTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('Leadership Not Found!');
                            }
                        });
                    }
             });
        }
    </script>
@endpush

