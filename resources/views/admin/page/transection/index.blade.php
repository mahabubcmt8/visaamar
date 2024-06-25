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
                                <div class="col-12" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle ?? 'N/A' }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped DataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">Id</th>
                                            <th class="text-left">User</th>
                                            <th class="text-center">Invoice Id</th>
                                            <th class="text-center">Wallet</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Credit Amount</th>
                                            <th class="text-center">Debit Amount</th>
                                            <th class="text-center">Credit Point</th>
                                            <th class="text-center">Debit Point</th>
                                            <th class="text-center">Note</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center" style="width: 100px;">Action</th>
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

    <!-- Modal -->
    <div class="modal fade" id="transectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transection Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="user">User <span class="text-danger">*</span></label>
                        <select name="user_id" class="select2 user_id form-control" id="user"></select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Invoice Id <span class="text-danger">*</span></label>
                        <input name="invoice_id" class="invoice_id form-control" id="invoice_id" placeholder="Invoice Id">
                    </div>
                    <div class="form-group mb-3">
                        <label for="wallet_type">Wallet Type<span class="text-danger">*</span></label>
                        <select name="wallet_type" class="wallet_type select2 form-control" id="wallet_type">
                            <option value selected>Select</option>
                            <option value="{{ App\Helpers\Constant::WALLET_TYPE['active_balance'] }}">Active Balance</option>
                            <option value="{{ App\Helpers\Constant::WALLET_TYPE['affiliate_comission'] }}">Affiliate Comission</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="transaction_type">Transaction Type<span class="text-danger">*</span></label>
                        <select name="transaction_type" class="transaction_type select2 form-control" id="transaction_type">
                            <option value selected>Select</option>
                            <option value="{{ App\Helpers\Constant::TRANSACTION_TYPE['add_fund'] }}">Add Fund</option>
                            <option value="{{ App\Helpers\Constant::TRANSACTION_TYPE['withdraw'] }}">Withdraw</option>
                            <option value="{{ App\Helpers\Constant::TRANSACTION_TYPE['product_sell'] }}">Product Sell</option>
                            <option value="{{ App\Helpers\Constant::TRANSACTION_TYPE['sell_commission'] }}">Sell Commission</option>
                            <option value="{{ App\Helpers\Constant::TRANSACTION_TYPE['product_purchase'] }}">Aproduct Purchase</option>
                            <option value="{{ App\Helpers\Constant::TRANSACTION_TYPE['generation_income'] }}">Generation Income</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Credit Amount <span class="text-danger">*</span></label>
                        <input name="credit_amount" class="credit_amount form-control" id="credit_amount" placeholder="Credit Amount">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Debit Amount <span class="text-danger">*</span></label>
                        <input name="debit_amount" class="debit_amount form-control" id="debit_amount" placeholder="Debit Amount">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Credit Point <span class="text-danger">*</span></label>
                        <input name="credit_point" class="credit_point form-control" id="credit_point" placeholder="Credit Point">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Debit Amount <span class="text-danger">*</span></label>
                        <input name="debit_point" class="debit_point form-control" id="debit_point" placeholder="Debit Point">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status<span class="text-danger">*</span></label>
                        <select name="status" class="status select2 form-control" id="status">
                            <option value selected>Select</option>
                            <option value="{{ App\Helpers\Constant::STATUS['approved'] }}">Approved</option>
                            <option value="{{ App\Helpers\Constant::STATUS['pending'] }}">Pending</option>
                            <option value="{{ App\Helpers\Constant::STATUS['rejected'] }}">Rejected</option>
                            <option value="{{ App\Helpers\Constant::STATUS['cancel'] }}">Cancel</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @include('layouts.admin.all-select2')

    <script>

        $(document).ready(function(){
            users();
        });

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
                    data: function(d) {},
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle the error, e.g., display a message or take appropriate action
                        console.error("Error: " + textStatus, errorThrown);
                    },
                },

                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'user',
                        name: 'user',
                        className: 'text-left',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'invoice_id',
                        name: 'invoice_id',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'wallet_type',
                        name: 'wallet_type',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'transaction_type',
                        name: 'transaction_type',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'cred_amount',
                        name: 'cred_amount',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'deb_amount',
                        name: 'deb_amount',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'cred_point',
                        name: 'cred_point',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'deb_point',
                        name: 'deb_point',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'transaction_note',
                        name: 'transaction_note',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                ]

            });

        });

        $.fn.dataTable.ext.buttons.reset = {
            text: '<i class="fas fa-undo d-inline"></i> Reset',
            action: function(e, dt, node, config) {
                dt.clear().draw();
                dt.ajax.reload();
            }
        };

        function rest(){
            $('.user_id').val('').trigger('change');
            $('#invoice_id').val('');
            $('#wallet_type').val('').trigger('change');
            $('#transaction_type').val('').trigger('change');
            $('#credit_amount').val('');
            $('#debit_amount').val('');
            $('#credit_point').val('');
            $('#debit_point').val('');
            $('#status').val('').trigger('change');
        }

        function destroy(id) {
            if (id != null) {
                var url = "{{ route('admin.transaction.destroy', ':id') }}";
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
                                success_msg('Transection Deleted Successfully.');
                                $('.DataTable').DataTable().ajax.reload();
                            },
                            error: function() {
                                warning_msg('Transection Not Found!');
                            }
                        });
                    }
                });
            } else {
                error_msg('Transection Id Not Found!');
            }
        }

        function edit(id) {
            $('#transectionModal').modal('show');
            var url = "{{ route('admin.transaction.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('.user_id').val(data.user.username).trigger('change');
                    $('#invoice_id').val(data.invoice_id);
                    $('#wallet_type').val(data.wallet_type).trigger('change');
                    $('#transaction_type').val(data.transaction_type).trigger('change');
                    $('#credit_amount').val(data.cred_point);
                    $('#debit_amount').val(data.deb_amount);
                    $('#credit_point').val(data.cred_point);
                    $('#debit_point').val(data.deb_point);
                    $('#status').val(data.status).trigger('change');
                },
                error: function() {
                    warning_msg('Transection Not Found!');
                }
            });
        }
    </script>
@endpush
