@extends('layouts.admin.app')
@section('content')
<style>
    .bg-light {
        background-color: #28a745!important;
        /* color: white; */
    }
    .bg-light, .bg-light>a {
        /* color: #1f2d3d!important; */
        color: #fff!important;
    }
</style>
<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
       <div class="row mb-2">
          <div class="col-sm-6">
             <h1>Tours</h1>
          </div>
          <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tours</li>
             </ol>
          </div>
       </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row offset-1">
        <div class="col-10">
          <div class="card card-primary card-outline shadow-lg">
            <div class="card-header">
               <div class="row">
                  <div class="col-sm-6">
                     <h3 class="card-title">
                        Add New Tours
                     </h3>
                  </div>
                  <div class="col-sm-6 text-right">
                     <a href="{{ route('admin.tour.index') }}" class="btn btn-danger">
                     <i class="fas fa-long-arrow-alt-left"></i>
                     Back to List
                     </a>
                  </div>
               </div>
            </div>
            <form action="{{ route('admin.tour.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row m-4">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="title">Tour Title: <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control" placeholder="Enter tour title" >
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_country">Tour Country: <span class="text-danger">*</span></label>
                       <input type="text" name="tour_country" value="{{ old('tour_country') }}" id="tour_country" class="form-control" placeholder="Enter tour country" >
                       @error('tour_country')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_division">Tour Division: <span class="text-danger">*</span></label>
                       <input type="text" name="tour_division" value="{{ old('tour_division') }}" placeholder="Type and hit enter to add a division" class="form-control" required>
                       @error('tour_division')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_day">Tour Day: <span class="text-danger">*</span></label>
                       <input type="number" name="tour_day" min="0" value="{{ old('tour_day') }}" id="tour_day" class="form-control" placeholder="Enter tour day" >
                       @error('tour_day')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_group">Tour Group: <span class="text-danger">*</span></label>
                       <input type="text" name="tour_group" value="{{ old('tour_group') }}" id="tour_group" class="form-control" placeholder="Enter tour group" >
                       @error('tour_group')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="depture">Tour Depture: <span class="text-danger">*</span></label>
                       <input type="text" name="depture" value="{{ old('depture') }}" id="depture" class="form-control" placeholder="Enter tour depture" >
                       @error('depture')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="depture_time">Tour Depture time: <span class="text-danger">*</span></label>
                       <input type="date" name="depture_time" value="{{ old('depture_time') }}" id="depture_time" class="form-control" placeholder="Enter tour depture time" >
                       @error('depture_time')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="return_time">Tour Depture Return time: <span class="text-danger">*</span></label>
                       <input type="date" name="return_time" value="{{ old('return_time') }}" id="return_time" class="form-control" placeholder="Enter tour depture return time" >
                       @error('return_time')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="dress_code">Dress Code: <span class="text-danger">*</span></label>
                       <input type="text" name="dress_code" value="{{ old('dress_code') }}"  placeholder="Type and hit enter to add a dress code" class="form-control" >
                       @error('dress_code')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="price_includes">Price Includes: <span class="text-danger">*</span></label>
                       <input type="text" name="price_includes" value="{{ old('price_includes') }} placeholder="Type and hit enter to add a price includes" class="form-control" >
                       @error('price_includes')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="price_excludes">Price Excludes: <span class="text-danger">*</span></label>
                       <input type="text" name="price_excludes" value="{{ old('price_excludes') }}"  placeholder="Type and hit enter to add a price excludes" class="form-control" >
                       @error('price_excludes')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="regular_price" class="form-label">Regular Price:</label>
                        <input type="number" min="0" name="regular_price" class="form-control" id="regular_price" placeholder="Enter product regular price" value="{{ old('regular_price') }}" >
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="discount_price" class="form-label">Discount Price:</label>
                        <input type="number" min="0" name="discount_price" class="form-control" id="discount_price" placeholder="Enter product discount price" value="{{ old('discount_price') }}" >
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputProductType" class="form-label">Tour Price Type:</label>
                    <select name="discount_type" class="form-control single-select" id="inputProductType" >
                        <option value="" selected disabled>---Select Discount---</option>
                        <option value="1">Flat</option>
                        <option value="2">Parcent %</option>
                      </select>
                    </div>
                </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="slider_image">Tour Image <span class="text-danger">(Size:1920,1280):</span></label>
                        <span class="text-danger">*</span>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input image" name="image" id="slider_img" >
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                           </div>
                           <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                           </div>
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-2 mt-3">
                           <img id="showImage" class="rounded avatar-lg showImage" src="{{ (!empty($editData->profile_image))? url('upload/admin_images/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="No Image" width="100px" height="80px;">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="description">Tour Short Description:
                        <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="description" name="description" ></textarea>
                     </div>
                     @error('description')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="status">Popular:</label>
                        <span class="text-danger">*</span>
                        <select name="is_popular" id="status" class="form-control" >
                           <option value="1">Active</option>
                           <option value="0">Disable</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="status">Status:</label>
                        <span class="text-danger">*</span>
                        <select name="status" id="status" class="form-control" >
                           <option value="1">Active</option>
                           <option value="0">Disable</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="status">Booking Link:</label>
                        <input type="text" name="booking_link" class="form-control" placeholder="Booking Link..." >
                     </div>
                  </div>

                  <div class="col-md-12 text-right">
                     <div class="form-group">
                        <button class="btn btn-success" type="submit">Submit</button>
                     </div>
                  </div>
               </div>
            </form>
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
