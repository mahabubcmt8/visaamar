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
                            <a class="btn btn-sm btn-primary" href="{{ route('user.client.create') }}"></i> Add User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-1">
                        <table class="table table-bordered text-center DataTable">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 50px;">SL</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Refer</th>
                                    <th class="text-center">Password</th>
                                    <th class="text-center">Status</th>
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

        $(function() {
            var dataTable;
            var url = "{{ url()->current() }}";

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
                        data: 'show_password',
                        name: 'show_password',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        searchable: true
                    }
                ]

            });

        });
    </script>
@endpush
