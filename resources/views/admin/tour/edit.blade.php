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
                        Edit Tours
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
            <form action="{{ route('admin.tour.update',$tour->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="row m-4">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="title">Tour Title: <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ $tour->title }}" id="title" class="form-control" placeholder="Enter tour title" required>
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_country">Tour Country: <span class="text-danger">*</span></label>
                       <input type="text" name="tour_country" value="{{ $tour->tour_country }}" id="tour_country" class="form-control" placeholder="Enter tour country" required>
                       @error('tour_country')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_division">Tour Division: <span class="text-danger">*</span></label>
                       <input type="text" name="tour_division" value="{{ $tour->tour_division }}"  placeholder="Type and hit enter to add a division" class="form-control" required>
                       @error('tour_division')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_day">Tour Day: <span class="text-danger">*</span></label>
                       <input type="number" name="tour_day" min="0" value="{{ $tour->tour_day }}" id="tour_day" class="form-control" placeholder="Enter tour day" required>
                       @error('tour_day')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="tour_group">Tour Group: <span class="text-danger">*</span></label>
                       <input type="text" name="tour_group" value="{{ $tour->tour_group }}" id="tour_group" class="form-control" placeholder="Enter tour group" required>
                       @error('tour_group')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="depture">Tour Depture: <span class="text-danger">*</span></label>
                       <input type="text" name="depture" value="{{ $tour->depture }}" id="depture" class="form-control" placeholder="Enter tour depture" required>
                       @error('depture')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="depture_time">Tour Depture time: <span class="text-danger">*</span></label>
                       <input type="date" name="depture_time" value="{{ $tour->depture_time }}" id="depture_time" class="form-control" placeholder="Enter tour depture time" required>
                       @error('depture_time')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="return_time">Tour Depture Return time: <span class="text-danger">*</span></label>
                       <input type="date" name="return_time" value="{{ $tour->return_time }}" id="return_time" class="form-control" placeholder="Enter tour depture return time" required>
                       @error('return_time')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="dress_code">Dress Code: <span class="text-danger">*</span></label>
                       <input type="text" name="dress_code" value="{{ $tour->dress_code }}"  placeholder="Type and hit enter to add a dress code" class="form-control" required>
                       @error('dress_code')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="price_includes">Price Includes: <span class="text-danger">*</span></label>
                       <input type="text" name="price_includes" value="{{ $tour->price_includes }}"  placeholder="Type and hit enter to add a price includes" class="form-control" required>
                       @error('price_includes')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                       <label for="price_excludes">Price Excludes: <span class="text-danger">*</span></label>
                       <input type="text" name="price_excludes" value="{{ $tour->price_excludes }}"  placeholder="Type and hit enter to add a price excludes" class="form-control" required>
                       @error('price_excludes')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <label for="regular_price" class="form-label">Regular Price:</label>
                        <input type="number" min="0" name="regular_price" class="form-control" id="regular_price" placeholder="Enter product regular price" value="{{ $tour->regular_price }}" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                        <label for="discount_price" class="form-label">Discount Price:</label>
                        <input type="number" min="0" name="discount_price" class="form-control" id="discount_price" placeholder="Enter product discount price" value="{{ $tour->discount_price }}" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputProductType" class="form-label">Tour Price Type:</label>
                    <select name="discount_type" class="form-control single-select" id="inputProductType" required>
                        <option value="" selected disabled>---Select Discount---</option>
                        <option value="1"  <?php if ($tour->discount_type == '1') echo "selected"; ?>>Flat</option>
                        <option value="2"  <?php if ($tour->discount_type == '2') echo "selected"; ?>>Parcent %</option>
                      </select>
                    </div>
                </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="slider_image">Tour Image <span class="text-danger">(Size:1920,1280):</span></label>
                        <span class="text-danger">*</span>
                        <div class="input-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input image" name="image" id="slider_img" required>
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
                           <img id="showImage" class="rounded avatar-lg showImage" src="{{ asset($tour->image) }}" alt="No Image" width="100px" height="80px;">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="description">Tour Short Description:
                        <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="description" name="description" required>{{ $tour->description }}</textarea>
                     </div>
                     @error('description')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="status">Popular:</label>
                        <span class="text-danger">*</span>
                        <select name="is_popular" id="is_popular" class="form-control" required>
                            @if ($tour->is_popular == 1)
                                <option value="1" selected>Active</option>
                                <option value="0">Disable</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected>Disable</option>
                            @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="status">Status:</label>
                        <span class="text-danger">*</span>
                        <select name="status" id="status" class="form-control" required>
                            @if ($tour->status == 1)
                                <option value="1" selected>Active</option>
                                <option value="0">Disable</option>
                            @else
                                <option value="1">Active</option>
                                <option value="0" selected>Disable</option>
                            @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="status">Booking Link:</label>
                        <input type="text" name="booking_link" class="form-control" placeholder="Booking Link..." value="{{ $tour->booking_link ?? ''  }}" required>
                     </div>
                  </div>
                  <div class="col-md-12 text-right">
                     <div class="form-group">
                        <button class="btn btn-success" type="submit">Update</button>
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
