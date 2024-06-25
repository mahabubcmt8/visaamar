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
                    <div class="table-responsive mt-1">
                        {{-- @for ($level = 1; $level <= 7; $level++)
                            @if(isset($counts["count_level_$level"]) && is_array($counts["count_level_$level"]))
                                <p>Level {{ $level }} Count: {{ $counts["count_level_$level"][0] ?? 0 }}</p>

                            @endif
                        @endfor --}}

                        @php
                            $totalTeamUserCount = 0;
                        @endphp
                        @for ($level = 1; $level <= 7; $level++)
                            @if(isset($counts["count_level_$level"]) && is_array($counts["count_level_$level"]))
                                @php
                                    $totalTeamUserCount += $counts["count_level_$level"][0] ?? 0;
                                @endphp
                            @endif
                        @endfor



                        <table id="" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Generation</th>
                                    <th class="text-center">User Count</th>
                                    {{-- <th class="text-center">Sales</th> --}}
                                </tr>
                            </thead>
                            <tbody class="text-center align-middle">
                                <tr>
                                    <td>1<sup>st</sup> Level</td>
                                    <td><a class="btn btn-sm btn-info" href="">{{ $counts['count_level_1'][0] ?? 0}}</a></td>
                                    {{-- <td>{{  number_format(0, 2) }}</td> --}}
                                </tr>
                                <tr>
                                    <td>2<sup>nd</sup> Level</td>
                                    <td><a class="btn btn-sm btn-info" href="">{{ $counts['count_level_2'][0] ?? 0 }}</a></td>
                                    {{-- <td>{{  number_format(0, 2) }}</td> --}}
                                </tr>
                                <tr>
                                    <td>3<sup>rd</sup> Level</td>
                                    <td><a class="btn btn-sm btn-info" href="">{{ $counts['count_level_3'][0] ?? 0 }}</a></td>
                                    {{-- <td>{{  number_format(0, 2) }}</td> --}}
                                </tr>
                                <tr>
                                    <td>4<sup>th</sup> Level</td>
                                    <td><a class="btn btn-sm btn-info" href="">{{ $counts['count_level_4'][0] ?? 0 }}</a></td>
                                    {{-- <td>{{  number_format(0, 2) }}</td> --}}
                                </tr>
                                <tr>
                                    <td>5<sup>th</sup> Level</td>
                                    <td><a class="btn btn-sm btn-info" href="">{{ $counts['count_level_5'][0] ?? 0 }}</a></td>
                                    {{-- <td>{{  number_format(0, 2) }}</td> --}}
                                </tr>
                                <tr>
                                    <td>6<sup>th</sup> Level</td>
                                    <td><a class="btn btn-sm btn-info" href="">{{ $counts['count_level_6'][0] ?? 0 }}</a></td>
                                    {{-- <td>{{  number_format(0, 2) }}</td> --}}
                                </tr>
                                <tr>
                                    <td>7<sup>th</sup> Level</td>
                                    <td><a class="btn btn-sm btn-info" href="">{{ $counts['count_level_7'][0] ?? 0 }}</a></td>
                                    {{-- <td>{{ number_format(0, 2) }}</td> --}}
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                  <td colspan="1" style="font-weight: bold; text-align: right;">Total:</td>
                                  <td style="font-weight: bold; text-align: center;">{{  $totalTeamUserCount }}</td>
                                  {{-- <td style="font-weight: bold; text-align: center;">{{  number_format($myScore, 2) }}</td> --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


