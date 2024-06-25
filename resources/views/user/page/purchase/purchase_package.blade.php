@extends('layouts.user.app')

@section('content')
    <style>
        .login-form div.form-group .password-show-btn{
            position: absolute;
            right: 30px;
            margin-top: -35px;
            font-size: 18px;
            cursor: pointer;
            color: #333;
            transition: 0.3s;
        }

        #verify{
            position: absolute;
            right: 30px;
            margin-top: -28px;
            font-size: 16px;
            cursor: pointer;
            color: #40bb7d;
            transition: 0.3s;
        }

        .login-form div.form-group #password-show:hover, .login-form div.form-group #con-password-show:hover {
            color: #20774b;
        }
        select.form-control, select.form-control:focus, select.form-control:hover{
            border: 1px solid #20774b;
        }

        .product {
            width: 100%;
            border: 1px solid #84b63fa6;
            border-radius: 4px;
            padding: 6px;
        }

        .product a {
            width: 100%;
            text-align: center;
        }

        .product a button {
            width: 100%;
            border: 1px solid #afcf82;
            border-radius: 4px;
            text-align: center;
            height: 155px;
            overflow: hidden;
        }

        .product a button:focus {
            outline: none;
        }
        .product a button img {
            max-height: 155px;
            border-radius: 2px;
        }
        .product .product-body {
            text-align: left;
            margin-top: 10px;
        }
        .product .product-body h6{
            font-size: 12px;
            margin-top: 5px;
        }
        .product .product-body h5{
            font-size: 16px;
            margin-top: 5px;
        }


        .offer-price {
            color: #000;
            font-size: 14px;
            font-weight: 600;
            line-height: 16px;
        }
        .regular-price {
            color: #666 !important;
            font-size: 11px;
            font-weight: 500;
            line-height: 15px;
            text-decoration: line-through;
        }
        .product_plus_minus{
            display: block;
        }
        .product_plus_minus button {
            border: 1px solid #2bd891;
            padding: 2px 10px;
        }

        .product_plus_minus input {
            width: 80px;
            text-align: center;
            border: 1px solid #2bd891;
            font-weight: 600;
            font-size: 16px;
            padding: 2px;
            height: 26px;
        }

        .product_plus_minus button:focus, .product_plus_minus input:focus{
            outline: none;
        }

        .cart-sidebar-header {
            background: #1c2224 none repeat scroll 0 0;
            color: #fff;
            padding: 18px 20px;
        }
        .cart-list-product {
            border-bottom: 1px solid #ececec;
            overflow: hidden;
            padding: 14px 20px;
            position: relative;
        }
        .remove-cart {
            position: absolute;
            right: 18px;
            top: 12px;
        }
        .cart-list-product img {
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            -moz-border-right-colors: none;
            -moz-border-top-colors: none;
            border-color: #ececec #ececec #dcdcdc;
            border-image: none;
            border-radius: 2px;
            border-style: solid;
            border-width: 1px 1px 3px;
            box-shadow: 0 0 3px #ececec;
            float: left;
            height: 99px;
            margin: 0 15px 0 0;
            object-fit: scale-down;
            width: 82px;
        }
        .cart-list-product h5 {
            margin: 0;
        }
        .cart-list-product h5 a {
            font-size: 14px;
        }
        .cart-list-product h6 {
            font-size: 11px;
        }
        .cart-sidebar-footer {
            background: #ececec none repeat scroll 0 0;
            padding: 14px 20px;
        }
        .cart-store-details h6 {
            margin: 10px 0 19px;
        }
        .cart-store-details h6 {
            margin: 10px 0 19px;
        }
        .btn-secondary {
            /* background: #e96125 none repeat scroll 0 0 !important; */
            border: none;
            background: #84B63F;
            background: -moz-linear-gradient(-45deg, #84B63F 0%, #84B63F 100%);
            background: -webkit-linear-gradient(-45deg, #84B63F 0%,#84B63F 100%);
            background: linear-gradient(135deg, #84B63F 0%,#84B63F 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#84B63F', endColorstr='#84B63F',GradientType=1 );
        }
        .cart-sidebar {
            border: 1px solid #84b63f;
        }
    </style>
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header card-title align-middle">
                    <div class="d-flex">
                        <h5 class="">{{ $pageTitle }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 ">
                            <div class="row">
                                @foreach ($packages as $package)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                        <div class="product">
                                            <a href="">
                                                <div class="product-header">
                                                    {{-- <span class="badge badge-success">50% OFF</span> --}}
                                                    <button>
                                                        <img class="img-fluid" src="{{ ($package->image) ? asset('uploads/package/'.$package->image) : asset('frontend/img/small/1.jpg') }}">
                                                    </button>
                                                    {{-- <span class="veg text-success mdi mdi-circle"></span> --}}
                                                </div>
                                                <div class="product-body">
                                                    <h5>{{ substr($package->name, 0, 20) }}</h5>
                                                    <h6>Point : {{ $package->point }} AP</h6>
                                                    <h6 class="mt-0">Price : {{ currency()['symble'] }} {{ number_format($package->price, 2) }}</h6>
                                                </div>
                                            </a>
                                            <div>
                                                <button class="btn btn-secondary btn-sm form-control" onclick="addCart({{ $package->id }}, 1);">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cart-sidebar">
                                <div class="cart-sidebar-header">
                                    <h5> My Cart <span class="text-success itemCount2">(0 item)</span> <a data-toggle="offcanvas" class="float-right" href="javascript:"><i class="mdi mdi-close"></i></a></h5>
                                </div>
                                <div class="cart-sidebar-body">
                                    <table style="width: 100%;">
                                        <tbody class="AddCartBody">
                                            <tr><td class="text-center"><h6 class="my-3">No Item..</h6></td></tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart-sidebar-footer">
                                    <div class="cart-store-details">
                                        {{-- <p>Sub Total <strong class="float-right">$900.69</strong></p>
                                        <p>Delivery Charges <strong class="float-right text-danger">+ $29.69</strong></p> --}}
                                        <h6 class="mb-2">Total Point <strong class="float-right text-success total_point" style="color: #0cc5b7;">0.00</strong></h6>
                                        <h6>Sub Total <strong class="float-right text-success sub_total" style="color: #0cc5b7;">{{ currency()['symble'] }} 0.00</strong></h6>
                                    </div>
                                    <form action="{{ route('user.purchase.package.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="cookie_id" id="agent_cookie_id" value="{{ request()->cookie('agent_package_purchase_cookie_id') }}">
                                        <a href="javascript::">
                                            <button class="btn btn-secondary btn-lg btn-block text-left" type="button" onclick="event.preventDefault(); this.closest('form').submit();"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Purchase </span><span class="float-right"><strong class="sub_total_btn">{{ currency()['symble'] }} 0.00</strong> <span class="fa fa-arrow-right"></span></span></button>
                                        </a>
                                    </form>

                                </div>
                            </div>
                        </div>
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

        $(document).ready(function(){
            addCartData();
        });

        function addCart(product_id, qty) {
            var qty = $('.quantity').val() || qty;
            url = "{{ route('addCart.agent.package.purchase.store') }}";
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    product_id: product_id,
                    qty: qty,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                success: function(data) {
                    if (data == 'success') {
                        Swal.fire({
                            title: 'Congratulation',
                            text: "Package Add to cart Successfull.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        });
                        addCartData();
                    } else if (data == 'increase') {
                        Swal.fire({
                            title: 'Congratulation',
                            text: "Package Quantity Increased.",
                            icon: 'info',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        });
                        addCartData();
                    } else {
                        Swal.fire({
                            title: 'Sorry',
                            text: "Something Wrong.",
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes'
                        });
                    }
                }
            });
        }

        function addCartData() {
            url = "{{ route('addCart.agent.package.purchase.get.data') }}";
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                success: function(data) {

                    $('.itemCount').html(0);
                    $('.itemCount2').html('(0 item)');
                    $('.itemCount').html(data.length);
                    $('.itemCount2').html('('+ data.length +' item)');

                    var html = '';
                    var agent_cookie_id = '';
                    if(data.length != 0){
                        $.each(data, function(index, value) {
                            agent_cookie_id = value.cookie_id;

                            var priceText = '';
                            var product_price = 0;

                            priceText = '<p class="offer-price mb-0">{{ currency()['symble'] }} '+ value.package.price +'</p>';
                            product_price = value.package.price;

                            var proImage = "{{ asset('frontend/img/small/1.jpg') }}";
                            if((value.package.image != null)){
                                proImage = '{{ asset('uploads/package/') }}/' + value.package.image;
                            }

                            html += '<tr> <td> <div class="cart-list-product"> ';

                            html += '<input type="hidden" class="product_id" name="product_id[]" value="'+ value.package.id +'">';
                            html += '<input type="hidden" class="product_price" name="product_price[]" value="'+ product_price +'">';
                            html += '<input type="hidden" class="total_product_price" name="total_product_price[]" value="'+ (product_price * value.quantity).toFixed(2) +'">';
                            html += '<input type="hidden" class="product_point" name="product_point[]" value="'+ value.package.point +'">';
                            html += '<input type="hidden" class="total_product_point" name="total_product_point[]" value="'+ (value.package.point * value.quantity).toFixed(2) +'">';

                            html += '<a class="float-right remove-cart" href="javascript:" onclick="removeCartData('+ value.package.id +');"><i class="fa fa-times"></i></a>';

                            html += '<img class="img-fluid" src="'+ proImage +'" alt="">';

                            html += '<h5><a href="#">'+ value.package.name +'</a></h5>';

                            html += ' <h6 class="text-success"><strong><span class="text-success fa fa-coins"></span></strong> '+ value.package.point +' Point</h6>';

                            html += priceText;

                            html += '<div class="product_plus_minus mt-1 mb-2"><button id="decrement"><i class="fa fa-minus"></i></button><input type="number" class="quantity_row" id="quantity_row" name="quantity_row[]" min="1" value="' + value.quantity + '"><button id="increment"><i class="fa fa-plus"></i></button></div>';

                            html += '</div> </td></tr>';

                        });
                    }
                    else{
                        var html = '<tr><td class="text-center"><h6 class="my-3">No Item..</h6></td></tr>';
                    }

                    $('.AddCartBody').html('');
                    $('.AddCartBody').html(html);
                    $('#agent_cookie_id').val('');
                    $('#agent_cookie_id').val(agent_cookie_id);

                    updateSubTotal();
                    updatePointTotal();
                }
            });
        }

        function updateSubTotal(){
            var totalSubTotal = 0;
            $(".total_product_price").each(function() {
                totalSubTotal += parseFloat($(this).val()) || 0;
            });
            $(".sub_total").html('');
            $(".sub_total").html('{{ currency()['symble'] }} ' + totalSubTotal.toFixed(2));

            if('{{ Route::currentRouteName() }}' == 'checkout.index'){
                $('.sub_total_checkout').html('');
                $('.sub_total_checkout').html('{{ currency()['symble'] }} ' + totalSubTotal.toFixed(2));
            }

            $(".sub_total_btn").html('{{ currency()['symble'] }} ' + totalSubTotal.toFixed(2));
        }

        function updatePointTotal(){
            var total = 0;
            $(".total_product_point").each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            $(".total_point").html('');
            $(".total_point").html('<span class="text-warning fas fa-coins mr-2"></span>' + total.toFixed(2));

            if('{{ Route::currentRouteName() }}' == 'checkout.index'){
                $(".total_point_checkout").html('');
                $(".total_point_checkout").html('<span class="text-warning fas fa-coins mr-2"></span>' + total.toFixed(2));
            }
        }

        $(document).on("click", "#decrement", function() {
            var row = $(this).closest("tr");
            var product_id = parseInt(row.find(".product_id").val()) || 0;
            var quantity_row = parseInt(row.find(".quantity_row").val()) || 0;
            var product_price = parseFloat(row.find(".product_price").val()) || 0;
            var product_point = parseFloat(row.find(".product_point").val()) || 0;
            if (quantity_row > 1) {
                var result_qty = parseInt(quantity_row - 1);
                row.find(".quantity_row").val(result_qty);
                row.find(".total_product_price").val((product_price * result_qty).toFixed(2));
                row.find(".total_product_point").val((product_point * result_qty).toFixed(2));
                updateSubTotal();
                updatePointTotal();
                updateCookie(product_id, result_qty);
            }
        });

        $(document).on("click", "#increment", function() {
            var row = $(this).closest("tr");
            var product_id = parseInt(row.find(".product_id").val()) || 0;
            var quantity_row = parseInt(row.find(".quantity_row").val()) || 0;
            var product_price = parseFloat(row.find(".product_price").val()) || 0;
            var product_point = parseFloat(row.find(".product_point").val()) || 0;
            var result_qty = parseInt(quantity_row + 1);
            row.find(".quantity_row").val(result_qty);
            row.find(".total_product_price").val((product_price * result_qty).toFixed(2));
            row.find(".total_product_point").val((product_point * result_qty).toFixed(2));
            updateSubTotal();
            updatePointTotal();
            updateCookie(product_id, result_qty);
        });

        // working on
        $(document).on("keyup", "#quantity_row", function() {
          setTimeout(() => {
            var row = $(this).closest("tr");
            var product_id = parseInt(row.find(".product_id").val()) || 0;
            var quantity_row = parseInt(row.find(".quantity_row").val()) || 0;
            var product_price = parseFloat(row.find(".product_price").val()) || 0;
            var product_point = parseFloat(row.find(".product_point").val()) || 0;
            var result_qty = parseInt(quantity_row);
            row.find(".quantity_row").val(result_qty);
            row.find(".total_product_price").val((product_price * result_qty).toFixed(2));
            row.find(".total_product_point").val((product_point * result_qty).toFixed(2));
            updateSubTotal();
            updatePointTotal();
            updateCookie(product_id, result_qty);
          }, 1000);
        });

        function updateCookie(product_id, qty){
            var url = "{{ route('addCart.agent.package.purchase.update') }}";
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    product_id: product_id,
                    quantity: qty,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                success: function(data) {
                    if(data == 'error'){
                        addCartData();
                    }
                    else{
                        addCartData();
                    }
                }
            });
        }

        function removeCartData(product_id){
            var url = "{{ route('addCart.agent.package.purchase.destroy', ':product_id') }}";
            url = url.replace(':product_id', product_id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    addCartData();
                }
            });
        }
    </script>
@endpush
