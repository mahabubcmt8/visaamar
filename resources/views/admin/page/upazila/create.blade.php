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
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('admin.settings.upazila.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Division</label>
                                            <div class="cl-12">
                                                <select class="form-group select2" onchange="getDivisionById(this.value)" name="division_id" style="width: 100%;">
                                                    <option value="">-- Select Division --</option>
                                                    @foreach($divisionlst as $list)
                                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">District</label>
                                            <div class="cl-12">
                                                    <select id="district_list" class="form-group select2" name="district_id" style="width: 100%;">
                                                        <option value="">-- Select District --</option>
                                                        @foreach($districtlst as $district)
                                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Upzila</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Upazila Name">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Bangla Upzila</label>
                                            <input type="text" name="bn_name" class="form-control" placeholder="Enter Upazila Name">
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Add Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

<script>
   function getDivisionById(division_id) {
    $.ajax({
        url:"{{route('admin.settings.upazila.getDistricByDivisiion')}}",
        method:"get",
        data:{id:division_id},
        DataType: "jSON",
        success: function (response) {
            var option= '';
            option += ' <option value="">-- Select District --</option>';
            $.each(response, function (key, value) {
                option += '<option value="'+value.id+'"> '+value.name+' </option>';
            });
            $('#district_list').empty();
            $('#district_list').append(option);
        }
    })
   }
</script>

