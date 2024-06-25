@extends('layouts.admin.app')

@section('content')
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header bg-secondary align-middle">
                    <h5 class="card-title">{{ $pageTitle }}</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
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
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">SL</th>
                                    <th class="text-left">User</th>
                                    <th class="text-center">Method</th>
                                    <th class="text-center">Wallet No.</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Currency</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Updated Date</th>
                                    <th class="text-center" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            $('#datatable').DataTable().ajax.reload();
        });

        $(function() {
            var dataTable;

            $("#form_date, #to_date").on("change", function() {
                dataTable.ajax.reload();
            });

            var url = "{{ url()->current() }}";

            @if (request()->has('approved_list'))
                var url = "{{ url()->current() }}" + "?approved_list";
            @endif

            @if (request()->has('rejected_list'))
                var url = "{{ url()->current() }}" + "?rejected_list";
            @endif

            dataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                ajax: {
                    url: url,
                    data: function(d) {
                        d.form_date = $("#form_date").val();
                        d.to_date = $("#to_date").val();
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
                        data: 'user',
                        name: 'user',
                        className: 'text-left',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'method',
                        name: 'method',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'wallet_address',
                        name: 'wallet_address',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'currency',
                        name: 'currency',
                        className: 'text-center',
                        searchable: true,
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
                        data: 'date',
                        name: 'date',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'approve_date',
                        name: 'approve_date',
                        className: 'text-center',
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

        function status(id, status, withdraw_status){
            let text = '';
            let icon = 'warning';
            let success_text = '';
            if(withdraw_status == "{{ App\Helpers\Constant::WITHDRAW_STATUS['approved'] }}"){
                text = 'You Want to approve this withdrawal request!';
                icon = 'warning';
                success_text = 'Request Approved';
            }
            if(withdraw_status == "{{ App\Helpers\Constant::WITHDRAW_STATUS['pending'] }}"){
                text = 'You Want to pending this withdrawal request!';
                icon = 'warning';
                success_text = 'Request Pending';
            }
            if(withdraw_status == "{{ App\Helpers\Constant::WITHDRAW_STATUS['rejected'] }}"){
                text = 'You Want to rejected this withdrawal request!';
                icon = 'warning';
                success_text = 'Request Rejected';
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
                    var url = "{{ route('admin.withdraw.status', [':id', ':status', ':withdraw_status']) }}";
                    url = url.replace(':id', id);
                    url = url.replace(':status', status);
                    url = url.replace(':withdraw_status', withdraw_status);
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
