@extends('layouts.admin.app')
@section('content')
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
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline shadow-lg mb-4">
            <div class="card-header py-3">
               <div class="row">
                  <div class="col-sm-6">
                     <h3 class="card-title m-0 font-weight-bold text-primary">
                        Tours Details
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
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-bordered">
                      <tr>
                        <td>Tour Booking Link</td>
                        <td>{{ $tour->booking_link ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Title</td>
                        <td>{{ $tour->title ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Country</td>
                        <td>{{ $tour->tour_country ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Division</td>
                        <td>{{ $tour->tour_division ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Day</td>
                        <td>{{ $tour->tour_day ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Group</td>
                        <td>{{ $tour->tour_group ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Depture Time</td>
                        <td>{{ $tour->depture_time ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Depture Return Time</td>
                        <td>{{ $tour->return_time ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Dress Code</td>
                        <td>{{ $tour->dress_code ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Price Includes</td>
                        <td>{{ $tour->price_includes ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Price</td>
                        <td style="font-weight: bold;">৳{{ number_format($tour->regular_price, 2) }}</td>
                     </tr>
                     <tr>
                        <td>Tour Discount Price</td>
                        <td>
                            @if($tour->discount_price > 0)
                                @if($tour->discount_type == 1)
                                    <span class="badge bg-info text-white">৳{{ $tour->discount_price }} off</span>
                                @elseif($tour->discount_type == 2)
                                    <span class="badge bg-success text-white">{{ $tour->discount_price }}% off</span>
                                @endif
                            @else
                                <span class="badge bg-danger text-white">No Discount</span>
                            @endif
                        </td>
                     </tr>
                     <tr>
                        <td>Tour Price Excludes</td>
                        <td>{{ $tour->price_excludes ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Depture</td>
                        <td>{{ $tour->depture ?? 'NULL' }}</td>
                     </tr>
                     <tr>
                        <td>Tour Description</td>
                        <td>{!! Str::limit($tour->description, 600) !!}</td>
                     </tr>
                     <tr>
                        <td>Popular</td>
                        <td>
                            @if ($tour->is_popular == 1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Disable</span>
                            @endif
                        </td>
                      </tr>
                      <td>Status</td>
                      <td>
                          @if ($tour->status == 1)
                          <span class="badge badge-success">Active</span>
                          @else
                          <span class="badge badge-danger">Disable</span>
                          @endif
                      </td>


                      <tr>
                        <td>Tour Image</td>
                        <td>
                           <img src="{{ asset($tour->image) }}" alt="" style="height:70px; width:80px;">
                        </td>
                     </tr>
                     </tr>
                  </table>
               </div>
            </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 </div>
@endsection
