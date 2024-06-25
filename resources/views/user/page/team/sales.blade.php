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
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-1">

                        <table id="" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Generation</th>
                                    <th class="text-center">User Count</th>
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


