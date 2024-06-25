<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductExtaInfo;
use App\Models\ProductFeaturedImage;
// use App\Models\ProductExtaInfo;
// use App\Models\ProductFeaturedImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;


class ProductController extends Controller
{
    public  $divisionId, $districtId;
    use RowIndex;
    public function index()
    {
        $pageTitle = 'Land and Property List';

        if (request()->ajax()) {
            $data = Product::orderBy('id', 'DESC');
            if (request()->title != '') {
                $data = $data->where('title', 'like', '%' . request()->title . '%');
            }

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('product', function ($row) {
                    $cat = $row->category->category_name ?? 'N/A';
                    $subcat = $row->subcategory->subcategory ?? 'N/A';
                    $info = <<<HTML
                        <table class="table table-sm table-borderless mb-0">
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Title</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->title</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Sub Title</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->sub_title</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Category</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$cat</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Sub Category</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$subcat</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Original Price</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->price</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Offer Price</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->offer_price</td>
                            </tr>

                        </table>
                    HTML;
                    return $info;
                })
                ->addColumn('image', function ($row) {
                    if ($row->thumbnail != null) {
                        $img = asset('uploads/product/' . $row->thumbnail);
                    } else {
                        $img = asset('uploads/product/' . $row->thumbnail);
                    }
                    $html = '<div class="text-center" uk-lightbox><a href="' . $img . '">
                        <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="' . $img . '" alt="">
                    </a></div>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="' . route('admin.product.edit', $row->id) . '"  class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></a>';
                    $btn2 = '<button onclick="destroy(' . $row->id . ')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    $btn3 = '<a href="#" class="btn btn-sm btn-success mr-2"><i class="fas fa-eye"></i></a>';
                    return $btn3 . $btn1 . $btn2;
                })
                ->rawColumns(['action', 'image', 'sl', 'product'])
                ->make(true);
        }

        return view('admin.page.products.products', compact('pageTitle'));
    }

    public function search(Request $request) {


    }

    public function create()
    {
        $divisions = Division::get(['name', 'id']);
        $districts = District::get(['name', 'id']);
        $upazilas = Upazila::all();
        $products = Product::all();
        $pageTitle = 'Create Property';
        return view('admin.page.products.create', compact('pageTitle', 'divisions', 'districts', 'upazilas', 'products'));
    }

    public function store(Request $request)
    {
        //        return $request->all();
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['nullable'],
            'title' => ['required'],
            'sub_title' => ['required'],

            'division_id' => ['nullable'],
            'district_id' => ['nullable'],
            'upazila_id' => ['nullable'],
            'address' => ['nullable'],
            'youtube' => ['nullable'],
            'property_size' => ['nullable'],
            'google_map' => ['nullable'],

            // 'slug' => ['required', 'unique:products'],
            'point' => ['nullable'],
            'price' => ['required'],
            'thumbnail' => ['required'],
        ]);

        $slug = Str::slug($request->slug, '-') . '-' . rand(1, 500) . rand(200, 900) . rand(1, 500) . rand(200, 900);

        $data = new Product;
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->point = 0;
        $data->price = $request->price;
        $data->offer_price = 0;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;

        $data->division_id = $request->division_id;
        $data->district_id = $request->district_id;
        $data->upazila_id = $request->upazila_id;

        $data->address = $request->address;
        $data->youtube = $request->youtube;
        $data->property_size = $request->property_size;
        $data->google_map = $request->google_map;

        $data->slug = $slug;
        $data->description = $request->description;
        if ($request->policy) {
            $data->policy = Constant::POLICY_STATUS['active'];
        }
        if ($request->terms) {
            $data->terms = Constant::TERMS_STATUS['active'];
        }
        $data->status = Constant::PRODUCT_STATUS['active'];
        $data->sold_status = Constant::SOLD_STATUS['not_sold'];

        if ($request->hasFIle('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $slug . '.' . $thumbnail->getclientoriginalextension();
            Image::make($thumbnail)->save(public_path('uploads/product/' . $thumbnail_name));
            $data->thumbnail = $thumbnail_name;
        }
        $data->save();

        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            foreach ($featured_image as $value) {
                $ga_image_name = $slug . '-featured-image-product-id-' . rand(100, 900) . '-' . $data->id . '.' . $value->getclientoriginalextension();
                Image::make($value)->save(public_path('uploads/product/' . $ga_image_name));
                $gallery = new ProductFeaturedImage;

                $gallery->product_id = $data->id;
                $gallery->image = $ga_image_name;
                $gallery->save();
            }
        }

        if ($request->row_id) {
            foreach ($request->row_id as $key => $value) {
                $extra_info = new ProductExtaInfo;
                $extra_info->product_id = $data->id;
                $extra_info->info_title = $request->info_title[$key];
                $extra_info->info_details = $request->info_details[$key];
                $extra_info->save();
            }
        }

        flash()->addSuccess('Product Added Successfully!');
        return redirect()->route('admin.product.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product == true) {

            $product->featuredImages()->get();
            $product->product_info()->delete();

            $product->delete();
            return response()->json($product);
        }
        return response()->json($product);
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Land and Property List';
        $product = Product::findOrFail($id);
        $divisions = Division::all();
        $districts = District::all();
        $upazilas = Upazila::all();
        return view('admin.page.products.edit', compact('pageTitle', 'product', 'divisions', 'districts', 'upazilas'));
    }

    public function infoItem($id)
    {
        $item = ProductExtaInfo::findOrFail($id);
        $item->delete();
        return response()->json($item);
    }
    public function feature_remove($id)
    {
        $item = ProductFeaturedImage::findOrFail($id);
        $item->delete();
        return response()->json($item);
    }
    public function thumbnail_remove($id)
    {
        $item = Product::findOrFail($id);
        if ($item->thumbnail != null) {
            $old_img = public_path('uploads/product/' . $item->thumbnail);
            if (file_exists($old_img)) {
                unlink($old_img);
            }
        }
        $item->thumbnail = null;
        $item->save();
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory_id' => ['nullable'],
            'title' => ['required'],
            'sub_title' => ['required'],
            'division_id' => ['nullable'],
            'district_id' => ['nullable'],
            'upazila_id' => ['nullable'],
            'address' => ['nullable'],
            'youtube' => ['nullable'],
            'property_size' => ['nullable'],
            'google_map' => ['nullable'],
            'sold' => ['nullable'],
            'point' => ['nullable'],
            'price' => ['required'],
            'thumbnail' => ['nullable', 'mimes:jpg,png,jpeg,gif,svg'],
        ]);




        $data = Product::findOrFail($id);
        $data->category_id = $request->category_id;
        $data->subcategory_id = $request->subcategory_id;
        $data->point = $request->point;
        $data->price = $request->price;
        $data->offer_price = $request->offer_price ?? 0;
        $data->title = $request->title;
        $data->sub_title = $request->sub_title;

        $data->division_id = $request->division_id;
        $data->district_id = $request->district_id;
        $data->upazila_id = $request->upazila_id;
        $data->address = $request->address;

        $data->description = $request->description;
        $data->youtube = $request->youtube;
        $data->property_size = $request->property_size;
        $data->google_map = $request->google_map;
        if ($request->policy) {
            $data->policy = Constant::POLICY_STATUS['active'];
        }
        if ($request->terms) {
            $data->terms = Constant::TERMS_STATUS['active'];
        }
        $data->status = Constant::PRODUCT_STATUS['active'];
        $data->sold_status = $request->sold;

        if ($request->hasFIle('thumbnail')) {
            if ($data->thumbnail != null) {
                $old_img = public_path('uploads/product/' . $data->thumbnail);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = $data->slug . '.' . $thumbnail->getclientoriginalextension();
            Image::make($thumbnail)->save(public_path('uploads/product/' . $thumbnail_name));
            $data->thumbnail = $thumbnail_name;
        }

        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            foreach ($featured_image as $value) {
                $ga_image_name = $data->slug . '-featured-image-product-id-' . rand(100, 900) . '-' . $data->id . '.' . $value->getclientoriginalextension();
                Image::make($value)->save(public_path('uploads/product/' . $ga_image_name));
                $gallery = new ProductFeaturedImage;

                $gallery->product_id = $data->id;
                $gallery->image = $ga_image_name;
                $gallery->save();
            }
        }

        if ($request->row_id) {
            ProductExtaInfo::where('product_id', $data->id)->delete();
            foreach ($request->row_id as $key => $value) {
                $extra_info = new ProductExtaInfo;
                $extra_info->product_id = $data->id;
                $extra_info->info_title = $request->info_title[$key];
                $extra_info->info_details = $request->info_details[$key];
                $extra_info->save();
            }
        }

        $data->save();

        flash()->addSuccess('Product Update Successfully!');
        return redirect()->route('admin.product.index');
    }
}
