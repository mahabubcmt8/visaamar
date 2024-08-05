@extends('layouts.frontend.app')
@section('content')
<style>
    .card-header{
        border-radius: 0 !important;
    }
</style>
<div class="breadcrumb-section" style="background-image: linear-gradient(270deg, rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3) 101.02%), url({{ asset('frontend/img/innerpage/inner-banner-bg.png') }});">
    <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center">

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-5">
                    <div class="card-body">
                        <h3 class="text-center">Visa</h3>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <select name="" class="form-control form-control-sm" id="country">
                                    <option value="">Select</option>
                                    @foreach ($countries as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" style="border-radius: 20px;" id="search">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="visa-data">

        </div>
    </div>
@endsection
@push('js')
<script>
    $("#search").on('click', function(){
        var country_id = $("#country").val();
        var url = "{{ route('visa.data', ":id") }}";
        url = url.replace(':id', country_id);

        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                $('.visa-data').html(data);
            }
        });
    });
</script>
@endpush

