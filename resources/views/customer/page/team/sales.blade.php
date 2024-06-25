@extends('layouts.customer.app')

@section('content')
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header card-title align-middle">
                    <div class="d-flex">
                        <div class="w-50 align-middle">
                            <h5 class="">{{ $pageTitle }}</h5>
                            <button type="button" class="btn btn-secondary" onclick="getInvest();">Refresh</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="my_sales_amount">My Seles Amount : {{ currency()['symble'] }}  0.00</h5>
                            <h5 class="my_sales_point">My Seles Point : {{ currency()['symble'] }}  0.00</h5>
                        </div>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table text-center table-bordered" style="font-size: 16px;" id="datatable">
                            <thead>
                                <tr >
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Sales Amount</th>
                                    <th class="text-center">Sales Point</th>
                                </tr>
                            </thead>
                            <tbody class="tabledata">
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-right"><strong>Total</strong></td>
                                    <td class="text-center"><strong class="total_sales_amount">{{ currency()['symble'] }}  00.00</strong> <strong></strong></td>
                                    <td class="text-center"><strong class="total_sales_point">00</strong> <strong>AP</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js" integrity="sha512-b94Z6431JyXY14iSXwgzeZurHHRNkLt9d6bAHt7BZT38eqV+GyngIi/tVye4jBKPYQ2lBdRs0glww4fmpuLRwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            getInvest();
        });

        // axios request for geting gen invest data
        function getInvest(){
            let total_sales_amount = 0;
            let total_sales_point = 0;
            $(".tabledata").empty();
            $('.my_sales_amount').html('')
            $('.my_sales_point').html('')
            $('.total_sales_amount').html('')
            $('.total_sales_point').html('')
            axios.get("{{ route('user.customer.refer.team.invest') }}")
            .then(res=> {
                // console.log(res);
                html="<tr>"
                res.data.links.forEach(function(d){
                    total_sales_amount += d.deposit;
                    total_sales_point += d.point;
                    html+='<td class="text-center">' + d.username + '</td>';
                    html+='<td class="text-center">' + (d.deposit).toFixed(2) + ' {{ currency()['symble'] }} </td>';
                    html+='<td class="text-center">' + (d.point).toFixed(2) + ' AP</td></tr>';
                })
                $(".tabledata").html(html);

                $('.my_sales_amount').html('My Seles Amount : ' + res.data.sales_amount.toFixed(2));
                $('.my_sales_point').html('My Seles Point : ' + res.data.sales_point.toFixed(2));
                $('.total_sales_amount').html('{{ currency()['symble'] }} '+total_sales_amount.toFixed(2));
                $('.total_sales_point').html(total_sales_point.toFixed(2));
            });
        }

    </script>
@endpush


