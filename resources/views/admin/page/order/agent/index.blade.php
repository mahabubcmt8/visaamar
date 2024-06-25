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
                                <div class="col-12" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-sm-2 col-12">
                                    <label for="user_name">Search By Username</label>
                                    <div class="input-group">
                                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Search by username">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-12">
                                    <label for="">Search by Date</label>
                                    <div class="input-group">
                                        <input type="text" name="form_date" id="form_date" class="form-control datepicker" placeholder="Enter Form Date">
                                        <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="Enter To Date">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-6">
                                    <label for="button">&nbsp;</label>
                                    <button class="btn btn-block btn-secondary" id="clearFilter">Clear Filter</button>
                                </div>
                            </div>
                            <div class="table-responsive mt-1">
                                <table class="table table-bordered text-center" id="datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">SL</th>
                                            <th class="text-center" style="width: 120px;">Purchase Id</th>
                                            <th class="text-center" style="width: 120px;">Date</th>
                                            <th class="text-left">User</th>
                                            <th class="text-center" style="width: 120px;">Point</th>
                                            <th class="text-center" style="width: 120px;">Order Amount</th>
                                            <th class="text-center" style="width: 120px;">Updated Date</th>
                                            <th class="text-center" style="width: 120px;">Status</th>
                                            <th class="text-center"  style="width: 200px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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

        $("#clearFilter").on('click', function() {
            $("#form_date").val('');
            $("#to_date").val('');
            $("#user_name").val('');
            $('#datatable').DataTable().ajax.reload();
        });

        $(function() {
            var dataTable;

            $("#form_date, #to_date").on("change", function() {
                dataTable.ajax.reload();
            });
            $("#user_name").on("keyup", function() {
                dataTable.ajax.reload();
            });

            var url = "{{ url()->current() }}";

            @if (request()->has('placed_orders'))
                var url = "{{ url()->current() }}" + "?placed_orders";
            @endif

            @if (request()->has('logistic_orders'))
                var url = "{{ url()->current() }}" + "?logistic_orders";
            @endif

            @if (request()->has('deliverd_orders'))
                var url = "{{ url()->current() }}" + "?deliverd_orders";
            @endif

            @if (request()->has('rejected_orders'))
                var url = "{{ url()->current() }}" + "?rejected_orders";
            @endif

            dataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                searching: false,
                ajax: {
                    url: url,
                    data: function(d) {
                        d.form_date = $("#form_date").val();
                        d.to_date = $("#to_date").val();
                        d.user_name = $("#user_name").val();
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error("Error: " + textStatus, errorThrown);
                    }
                },

                columns: [
                    {
                        data: 'sl',
                        name: 'sl',
                        className: 'text-center',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'order_id',
                        name: 'order_id',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'date',
                        name: 'date',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'user',
                        name: 'user',
                        className: 'text-left',
                        orderable: false
                    },
                    {
                        data: 'total_point',
                        name: 'total_point',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'sub_total',
                        name: 'sub_total',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'approve_date',
                        name: 'approve_date',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    }
                ]

            });

        });

        function status(id, status, order_status){
            let text = '';
            let icon = 'warning';
            let success_text = '';
            if(order_status == "{{ App\Helpers\Constant::ORDER_STATUS['placed'] }}"){
                text = 'You Want to approve this order request!';
                icon = 'warning';
                success_text = 'Order placed';
            }
            if(order_status == "{{ App\Helpers\Constant::ORDER_STATUS['pending'] }}"){
                text = 'You Want to pending this order request!';
                icon = 'warning';
                success_text = 'Order Request Pending';
            }
            if(order_status == "{{ App\Helpers\Constant::ORDER_STATUS['logistic'] }}"){
                text = 'You Want to shift logistic Partner this order!';
                icon = 'warning';
                success_text = 'Order shifted logistic Partner';
            }
            if(order_status == "{{ App\Helpers\Constant::ORDER_STATUS['rejected'] }}"){
                text = 'You Want to rejected this order!';
                icon = 'warning';
                success_text = 'Order Rejected';
            }
            if(order_status == "{{ App\Helpers\Constant::ORDER_STATUS['deliverd'] }}"){
                text = 'You Want to complete this order!';
                icon = 'warning';
                success_text = 'Order Deliverd';
            }

            Swal.fire({
                title: 'Are you sure?',
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value == true) {
                    var url = "{{ route('admin.purchase.status', [':id', ':status', ':order_status']) }}";
                    url = url.replace(':id', id);
                    url = url.replace(':status', status);
                    url = url.replace(':order_status', order_status);
                    $.ajax({
                        type: "get",
                        url: url,
                        success: function(data) {
                            Swal.fire({
                                title: 'Success',
                                text: success_text,
                                icon: 'success',
                                confirmButtonColor: '#448AFF',
                                confirmButtonText: 'OK'
                            });
                            $('#datatable').DataTable().ajax.reload();
                        },
                        error: function(data){

                        }
                    });
                }
            });
        }
    </script>
@endpush
