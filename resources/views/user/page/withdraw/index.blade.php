@extends('layouts.user.app')

@section('content')
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header card-title align-middle">
                    <div class="d-flex">
                        <div class="w-50 align-middle">
                            <h5 class="">{{ $pageTitle }}</h5>
                        </div>
                        <div class="w-50 text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('user.withdraw.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Withdraw</a>
                        </div>
                    </div>
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
                    <div class="table-responsive mt-1">
                        <table class="table table-bordered text-center" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">SL</th>
                                    <th class="text-center">Method</th>
                                    <th class="text-center">Wallet No.</th>
                                    <th class="text-center">Currency</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Updated Date</th>
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
                        data: 'currency',
                        name: 'currency',
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
                    }

                ],
                initComplete: function(settings, json) {
                    // Function to calculate and update footer totals
                    function updateFooterTotals() {
                        let total_amount = 0;

                        // Loop through the rows in the current page
                        dataTable.rows({
                            page: 'current'
                        }).data().each(function(rowData) {
                            let amount = parseFloat(rowData.amount);
                            if (!isNaN(amount)) {
                                total_amount += amount;
                            }
                        });

                        // Update the footer for totals
                        $('#datatable tfoot th:eq(1)').text(total_amount.toFixed(2)); //Total Point
                    }

                    // Add the footer row initially
                    $('#datatable').append('<tfoot class="text-center"><tr><th colspan="4" class="text-right">Total</th><th class="text-center"></th><th class="text-center"></th><th></th><th></th><th></th></tr></tfoot>');

                    // Calculate and update footer totals initially
                    updateFooterTotals();

                    // Bind the updateFooterTotals function to the draw.dt event
                    dataTable.on('draw.dt', function() {
                        updateFooterTotals();
                    });
                }

            });

        });
    </script>
@endpush
