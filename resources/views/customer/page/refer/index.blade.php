@extends('layouts.customer.app')

@section('content')
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header card-title align-middle">
                    <div class="d-flex">
                        <div class="w-50 align-middle">
                            <h5 class="">{{ $pageTitle }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-3">Share Refer Link</h5>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" id="refferal" value="{{ route('login').'?refer='.$user->username }}" name="refferal" readonly>
                            </div>
                            <div id="social-links">
                                <a href="{{ $shareBtn['facebook'] }}" class="btn social-button "id=""><span class="fa fa-facebook"></span></a>

                                <a href="{{ $shareBtn['whatsapp'] }}" class="btn social-button "id=""><span class="fa fa-whatsapp"></span></a>

                                <a href="{{ $shareBtn['telegram'] }}" class="btn social-button "id=""><span class="fa fa-telegram"></span></a>

                                <button type="submit" onclick="copyToClipboard()" class="my-3 mx-1 btn btn-theme copy-btn">Copy Link</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-bordered text-center" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">User Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Type</th>
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
        function copyToClipboard() {
            var copyGfGText = document.getElementById("refferal");
            copyGfGText.select();
            document.execCommand("copy");
            success_msg('Refer Link Copid!');
        }
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')
            }
        });

        $(function() {
            var dataTable;

            var url = "{{ url()->current() }}";
            dataTable = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                searching: false,
                ajax: {
                    url: url,
                    data: function(d) {
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
                        data: 'name',
                        name: 'name',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'username',
                        name: 'username',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'type',
                        name: 'type',
                        className: 'text-center',
                        searchable: true,
                        orderable: false
                    }

                ]

            });

        });


    </script>
@endpush
