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
                        <div class="w-50 text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('user.withdraw.index') }}"><i class="fa fa-list" aria-hidden="true"></i>Withdraw List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form onsubmit="event.preventDefault()">
                        <div class="mb-3">
                            <label for="method" class="form-label">Method <span class="text-danger">*</span> </label>
                            <select  class="form-control select2" id="method" placeholder="Enter Agent">
                                <option value="">SELECT</option>
                                @php
                                    $method = \App\Helpers\Constant::METHOD;
                                @endphp
                                @foreach($method as $key=> $m)
                                   <option value="{{$m}}">{{$key}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="method_msg"></div>
                        </div>
                        <div><span style="font-size:18px;font-weight:bold;" class="text-success" id="agent_wallet"></span></div>
                        <div class="mb-3">
                            <label for="wallet_no" class="form-label">Wallet No. <span class="text-danger">*</span> </label>
                            <input type="number" class="form-control" id="wallet_no" placeholder="Enter Number"
                                min="10">
                            <div class="invalid-feedback" id="wallet_no_msg"></div>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount BDT: <span class="text-danger">*</span> <span class="text-danger" id="bdt">0.00</span></label>
                            <input type="number" class="form-control" id="amount" placeholder="Enter Amount BDT">
                            <div class="invalid-feedback" id="amount_msg"></div>
                        </div>
                        <button class="btn btn-primary  mt-4 d-block w-100" onclick="formRequest()" type='submit'>Withdraw</button>
                    </form>
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

        function resetFrom(){
            $('#method').val('').toggle('change');
            $('#wallet_no').val('');
            $('#amount').val('');

            $('#method_msg').html('');
            $('#wallet_no_msg').html('');
            $('#amount_msg').html('');
        }

        window.formRequest = function() {
            $('input, select').removeClass('is-invalid');

            let method = $('#method').val();
            let wallet_no = $('#wallet_no').val();
            let amount = $('#amount').val();

            let formData = new FormData();
            formData.append('method', method);
            formData.append('wallet_no', wallet_no);
            formData.append('amount', amount);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                type: "POST",
                url: "{{ route('user.customer.withdraw.store') }}",
                dataType: "json",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    resetFrom();
                    Swal.fire({
                        title: 'Success',
                        text: 'Payment Request Successfully Submited',
                        icon: 'success',
                        confirmButtonColor: '#448AFF',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(data){
                    var keys = Object.keys(data.responseJSON.errors);

                    keys.forEach(function(d) {
                        $('#' + d).addClass('is-invalid');
                        $('#' + d + '_msg').text(data.responseJSON.errors[d]);
                        warning_msg('' + data.responseJSON.errors[d]);
                    });
                }
            });
        }
    </script>
@endpush
