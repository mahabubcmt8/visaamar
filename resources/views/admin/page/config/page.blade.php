@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company Info</h1>
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
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Page Banner</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.home.banner.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Home Page Banner <span class="text-danger"> *</span> <span>( Image Size: 1159 * 398 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Home Page Banner URL">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($home_banner as $banner)
                                            <div style="margin-right: 10px;" class="banner_img_{{ $banner->id }}">
                                                <div class="uploaded-img">
                                                    <img src="{{ asset('uploads/banner').'/'.$banner->img }}" alt="">
                                                    <span class="img-remove" onclick="remove('{{ $banner->type }}', 'banner_img_{{ $banner->id }}', '{{ $banner->id }}');">x</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group pt-3 text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Page Banner Section</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="text-muted">{{session('message')}}</p>
                            <form method="POST" action="{{ route('admin.settings.add_banner.banner.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Home Page Banner <span class="text-danger"> *</span> <span>( Image Size: 1500 * 440 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Home Page Banner URL">
                                            @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($hone_ads_banner as $ads_banner)
                                            <h1 class=""></h1>
                                            <div style="margin-right: 10px;" class="ads_banner_img_{{ $ads_banner->id }}">
                                                <div class="uploaded-img">
                                                    <img src="{{ asset('uploads/banner-section').'/'.$ads_banner->img }}" alt="">
                                                    <a href="{{route('admin.settings.add_banner.banner.remove', $ads_banner->id) }}" style="position: absolute; padding: 0px 8px; background: rgba(148,148,148,0.28); border-radius: 50%; margin-top: -10px; margin-left: -11px; color: #d90000; cursor: pointer;" onclick="return confirm('Are you sure to delete this?')">
                                                        x
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group pt-3 text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('js')
    <script>
        function remove(type, class_name, id){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this page banner?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('admin.settings.home.banner.remove', [':id', ':class_name']) }}';
                    url = url.replace(':id', id);
                    url = url.replace(':class_name', class_name);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+data).html('');
                        }
                    });

                }
            });
        }
    </script>
@endpush
