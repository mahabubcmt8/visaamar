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
                                    <button type="button" id="addClubBonusModalBtn"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table width='100%' class="table table-sm text-center" id="datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Asset</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('admin.modals.add-Club-bonus-details')
@endsection

@push('js')
    <script>
    var datatable;
    $(document).ready(function(){
        datatable= $('#datatable').DataTable({
            processing:true,
            serverSide:true,
            responsive:true,
            ajax:{
            url:"{{route('admin.club_bonus_details.index')}}"
            },
            columns:[

                {
                    data:'name',
                    name:'name',
                    className: 'align-middle',
                },
                {
                    data:'assets',
                    name:'assets',
                    className: 'align-middle',
                },
                {
                    data:'action',
                    name:'action',
                    className: 'align-middle',
                },
            ]
        });
    })
    </script>
@endpush

