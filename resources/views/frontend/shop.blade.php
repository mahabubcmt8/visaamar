@extends('layouts.frontend.app')

@section('content')
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('home') }}"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span
                        class="mdi mdi-chevron-right"></span>
                    <a href="{{ route('shop') }}">Property</a>
                    @if (request()->category)
                        <span class="mdi mdi-chevron-right"></span>
                        <a href="{{ route('shop') }}?category={{ request()->category }}">{{ category(request()->category)->category_name }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="shop-list section-padding">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    {{-- <a href="#"><img class="img-fluid mb-3" src="{{ asset('frontend/img/shop.jpg') }}" alt=""></a> --}}
                    <div class="shop-head border-bottom pb-2">
                        <a href="{{ route('home') }}"><span class="mdi mdi-home"></span> Home</a> <span
                            class="mdi mdi-chevron-right"></span>
                        <a href="#">Property</a>
                        @if (request()->category)
                            <span class="mdi mdi-chevron-right"></span>
                            <a
                                href="{{ route('shop') }}?category={{ request()->category }}">{{ category(request()->category)->category_name }}</a>
                        @endif
                        {{--                        <div class="btn-group float-right pb-2 mt-2"> --}}
                        {{--                            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" --}}
                        {{--                                aria-haspopup="true" aria-expanded="false"> --}}
                        {{--                                Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                        {{--                            </button> --}}
                        {{--                            <div class="dropdown-menu dropdown-menu-right"> --}}
                        {{--                                <a class="dropdown-item" href="#">Relevance</a> --}}
                        {{--                                <a class="dropdown-item" href="#">Price (Low to High)</a> --}}
                        {{--                                <a class="dropdown-item" href="#">Price (High to Low)</a> --}}
                        {{--                                <a class="dropdown-item" href="#">Discount (High to Low)</a> --}}
                        {{--                                <a class="dropdown-item" href="#">Name (A to Z)</a> --}}
                        {{--                            </div> --}}
                        {{--                        </div> --}}
                        {{-- <h5 class="mb-3">Fruits</h5> --}}
                    </div>
                    <div class="row">
                        @forelse ($products as $item)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mt-3">
                                <div class="product">
                                    <a href="{{ route('product', ['id' => $item->id, 'slug' => $item->slug]) }}">
                                        <div class="product-header">
                                            <img class="img-fluid"
                                                src="{{ $item->thumbnail ? asset('uploads/product/' . $item->thumbnail) : asset('frontend/img/small/1.jpg') }}"
                                                alt="{{ $item->slug }}">

                                        </div>
                                        <div class="product-body">
                                            <h5>{{ $item->title }} </h5>
                                            <h6 class="mb-1">{{ $item->sub_title }}</h6>
                                            <h6 class="my-0 py-0">{{ $item->category->category_name }}</h6>
                                            @if ($item->property_size != null)
                                                <h6 style="color: #75AA1B" class="my-0 py-0">
                                                    {{ $item->property_size }}
                                                </h6>
                                            @endif
                                            <h6 class="" style="color: #75AA1B">{{ $item->price }}</h6>
                                            <h6>{{ $item->created_at->format('g:i a d-M-Y ') }}</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-4 pmb-3 text-center"> No Products... </div>
                        @endforelse
                    </div>
                    @if (!request()->has('category') && !request()->has('thana'))
                        {!! $products->links('vendor.pagination.custom') !!}
                    @endif

                </div>
            </div>
        </div>
    </section>
    {{--    @include('frontend.module.guarantee') --}}
@endsection
