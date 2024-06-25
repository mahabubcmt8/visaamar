{{--@extends('layouts.admin.app')--}}
{{--@section('content')--}}
{{--    <!-- Content Header (Page header) -->--}}
{{--    <div class="content-header">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row mb-2">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <h1 class="m-0">{{ $pageTitle }}</h1>--}}
{{--                </div><!-- /.col -->--}}
{{--                <div class="col-sm-6">--}}
{{--                    <ol class="breadcrumb float-sm-right">--}}
{{--                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>--}}
{{--                        <li class="breadcrumb-item active">Dashboard</li>--}}
{{--                    </ol>--}}
{{--                </div><!-- /.col -->--}}
{{--            </div><!-- /.row -->--}}
{{--        </div><!-- /.container-fluid -->--}}
{{--    </div>--}}
{{--    <!-- /.content-header -->--}}

{{--    <!-- Main content -->--}}
{{--    <section class="content">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="card card-secondary">--}}
{{--                        <div class="card-header">--}}

{{--                            <div class="row">--}}
{{--                                <div class="col-6" style="vertical-align: middle; margin: auto;">--}}
{{--                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>--}}
{{--                                </div>--}}
{{--                                <div class="col-6 text-right">--}}
{{--                                    <button type="button" class="btn btn-success text-right" data-toggle="modal"--}}
{{--                                        data-target="#exampleModal"><i class="fas fa-plus-circle"></i> Add Rank</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-header -->--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table table-bordered table-striped DataTable">--}}
{{--                                    <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th class="text-center" style="width: 50px;">SL</th>--}}
{{--                                            <th class="text-center">Name</th>--}}
{{--                                            <th class="text-center">Username</th>--}}
{{--                                            <th class="text-center">Phone</th>--}}
{{--                                            <th class="text-center">Refer</th>--}}
{{--                                            <th class="text-center">Team Sales</th>--}}
{{--                                            <th class="text-center">Team Point</th>--}}
{{--                                            <th class="text-center">Self Sales</th>--}}
{{--                                            <th class="text-center">Self Point</th>--}}
{{--                                            <th class="text-center">Self Bonus</th>--}}
{{--                                            <th class="text-center">Team Bonus</th>--}}
{{--                                            <th class="text-center">Rank</th>--}}
{{--                                        </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}

{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-body -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div><!-- /.container-fluid -->--}}
{{--    </section>--}}
{{--    <!-- /.content -->--}}
{{--    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--        aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Add Rank User</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">Rank Name *</label>--}}
{{--                        <select name="rank_name" id="rank_name" class="form-control select2">--}}
{{--                            <option value="customer">Customer</option>--}}
{{--                            <option value="distributor">Distributor</option>--}}
{{--                            <option value="leader">Leader</option>--}}
{{--                            <option value="sales_manager">Sales Manager</option>--}}
{{--                            <option value="silver_director">Silver Director</option>--}}
{{--                            <option value="gold_director">Gold Director</option>--}}
{{--                            <option value="platinum_director">Platinum Director</option>--}}
{{--                            <option value="crown_director">Crown Director</option>--}}
{{--                            <option value="ruby_director">Ruby Director</option>--}}
{{--                            <option value="diamond_director">Diamond Director</option>--}}
{{--                            <option value="star_ambassador">Star Ambassador</option>--}}
{{--                            <option value="brand_ambassador">Brand Ambassador</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="">User *</label>--}}
{{--                        <select name="user" id="user" class="form-control select2">--}}
{{--                            <option value selected>Selected</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                    <button type="button" class="btn btn-primary" onclick="giveRank();">Add</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@push('js')--}}
{{--    @include('layouts.admin.all-select2')--}}
{{--    <script>--}}
{{--        function rest(){--}}
{{--            $('#rank_name').val('').trigger('change');--}}
{{--            $('#user').val('').trigger('change');--}}
{{--        }--}}
{{--        $(document).ready(function(){--}}
{{--            users();--}}
{{--        });--}}

{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}

{{--        $(function() {--}}
{{--            var dataTable;--}}

{{--            dataTable = $('.DataTable').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                pageLength: 100,--}}
{{--                dom: 'Bfrtip',--}}
{{--                buttons: [--}}
{{--                    // 'copy',--}}
{{--                    'excel',--}}
{{--                    'csv',--}}
{{--                    'pdf',--}}
{{--                    'print',--}}
{{--                    'reset'--}}
{{--                ],--}}
{{--                ajax: {--}}
{{--                    url: "{{ url()->current() }}",--}}
{{--                    data: function(d) {},--}}
{{--                    error: function(xhr, textStatus, errorThrown) {--}}
{{--                        // Handle the error, e.g., display a message or take appropriate action--}}
{{--                        console.error("Error: " + textStatus, errorThrown);--}}
{{--                    },--}}
{{--                },--}}

{{--                columns: [{--}}
{{--                        data: 'sl',--}}
{{--                        name: 'sl',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true,--}}
{{--                        orderable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'name',--}}
{{--                        name: 'name',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'username',--}}
{{--                        name: 'username',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'phone',--}}
{{--                        name: 'phone',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'refer',--}}
{{--                        name: 'refer',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'team_sales',--}}
{{--                        name: 'team_sales',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'team_point',--}}
{{--                        name: 'team_point',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'self_sales',--}}
{{--                        name: 'self_sales',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'self_point',--}}
{{--                        name: 'self_point',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'self_bonus',--}}
{{--                        name: 'self_bonus',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'team_bonus',--}}
{{--                        name: 'team_bonus',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    },--}}
{{--                    {--}}
{{--                        data: 'rank',--}}
{{--                        name: 'rank',--}}
{{--                        className: 'text-center',--}}
{{--                        searchable: true--}}
{{--                    }--}}


{{--                ]--}}

{{--            });--}}

{{--        });--}}

{{--        $.fn.dataTable.ext.buttons.reset = {--}}
{{--            text: '<i class="fas fa-undo d-inline"></i> Reset',--}}
{{--            action: function(e, dt, node, config) {--}}
{{--                dt.clear().draw();--}}
{{--                dt.ajax.reload();--}}
{{--            }--}}
{{--        };--}}

{{--        function giveRank(){--}}
{{--            let rank_name = $('#rank_name').val();--}}
{{--            let username = $('#user').val();--}}

{{--            if(username !== ''){--}}
{{--                var url = "{{ route('admin.rank.give.user.rank', ['rank_name' => ':rank_name', 'username' => ':username']) }}";--}}
{{--                url = url.replace(':rank_name', rank_name);--}}
{{--                url = url.replace(':username', username);--}}
{{--                $.ajax({--}}
{{--                    type: "GET",--}}
{{--                    url: url,--}}
{{--                    success: function(data) {--}}
{{--                        success_msg('Rank Added Successfully Done.');--}}
{{--                        rest();--}}
{{--                        $('.DataTable').DataTable().ajax.reload();--}}
{{--                    },--}}
{{--                    error:function(error){--}}
{{--                        error_msg('Some Error!');--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--            else{--}}
{{--                error_msg('Username Not Found! Please Select Valid User');--}}
{{--            }--}}
{{--        }--}}


{{--    </script>--}}
{{--@endpush--}}
