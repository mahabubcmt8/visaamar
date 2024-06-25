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
                                    @if (request()->has('agent_list'))
                                        <a href="{{ route('admin.user.create') }}?agent" class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New Agent</a>
                                    @else
                                        <a href="{{ route('admin.user.create') }}" class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New User</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped DataTable" >
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">SL</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Refer</th>
                                            <th class="text-center">Agent</th>
                                            <th class="text-center">Password</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center" style="width: 150px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')
            }
        });

        $(function() {
            var dataTable;

            var url = "{{ url()->current() }}";

            @if (request()->has('agent_list'))
            var url = "{{ url()->current() }}" + "?agent_list";
            @endif

            @if (request()->has('blocked'))
            var url = "{{ url()->current() }}" + "?blocked";
            @endif

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
                    url: url,
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
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'username',
                        name: 'username',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'refer',
                        name: 'refer',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'agent',
                        name: 'agent',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'show_password',
                        name: 'show_password',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'type',
                        name: 'type',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
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
    </script>
@endpush

