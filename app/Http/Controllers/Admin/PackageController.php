<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Helpers\Traits\RowIndex;
use App\Models\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use RowIndex;
    public function index()
    {
        $pageTitle = 'Package List';

        if (request()->ajax()) {
            $data = Package::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('name', function ($row) {
                    if ($row->status == 0) {
                        $status = '<span class="badge badge-success">Active</span>';
                    }else{
                        $status = '<span class="badge badge-danger">Deactive</span>';
                    }

                    if ($row->stock_status == 0) {
                        $stock_status = '<span class="badge badge-success">Active</span>';
                    }else{
                        $stock_status = '<span class="badge badge-danger">Deactive</span>';
                    }

                    $info = <<<HTML
                        <table class="table table-sm table-borderless mb-0">
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Name</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->name</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Price</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$row->price</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Status</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$status</td>
                            </tr>
                            <tr class="bg-transparent">
                                <td style="width: 100px !important;" class="font-weight-bolder">Stock Status</td>
                                <td style="width: 2px !important;" class="font-weight-bolder">:</td>
                                <td>$stock_status</td>
                            </tr>
                        </table>
                    HTML;
                    return $info;
                })
                ->addColumn('image', function ($row) {

                    if($row->image != null){
                        $img = asset('uploads/package/'.$row->image);
                    }
                    else{
                        $img = asset('uploads/package/'.$row->image);
                    }
                    $html = '<div class="text-center" uk-lightbox><a href="'.$img.'">
                        <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="'. $img .'" alt="">
                    </a></div>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="'.route('admin.package.edit', $row->id).'"  class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></a>';
                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    $btn3 = '<button onclick="packageView('. $row->id .')" class="btn btn-sm btn-success mr-2"><i class="fas fa-eye"></i></button>';
                    return $btn3.$btn1.$btn2;
                })
                ->rawColumns(['action', 'image', 'sl', 'name'])
                ->make(true);
        }

        return view('admin.page.packages.package', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Package';
        return view('admin.page.packages.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'point' => ['required'],
            'description' => ['nullable'],
            'image' => ['nullable'],
        ]);

        $slug = Str::slug($request->name, '-').'-'.rand(1,500);

        $data = new Package;
        $data->name = $request->name;
        $data->price = $request->price;
        $data->point = $request->point;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->stock_status = $request->stock_status;

        if ($request->hasFIle('image')){
            $image = $request->file('image');
            $image_name = $slug.'.'.$image->getclientoriginalextension();
            Image::make($image)->save(public_path('uploads/package/'.$image_name));
            $data->image = $image_name;
        }
        $data->save();

        flash()->addSuccess('package Added Successfully!');
        return redirect()->route('admin.package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $package = Package::findOrFail($id);
        return response()->json($package);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Package ';
        $package = Package::findOrFail($id);
        return view('admin.page.packages.edit', compact('pageTitle','package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'point' => ['required'],
            'description' => ['nullable'],
            'image' => ['nullable'],
        ]);

        $slug = Str::slug($request->name, '-').'-'.rand(1,500);

        $data = Package::findOrFail($id);
        $data->name = $request->name;
        $data->price = $request->price;
        $data->point = $request->point;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->stock_status = $request->stock_status;

        if ($request->hasFIle('image')){
            if($data->image != null){
                $old_img = public_path('uploads/package/'.$data->image);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }

            $image = $request->file('image');
            $image_name = $data->name.'.'.$image->getclientoriginalextension();
            Image::make($image)->save(public_path('uploads/package/'.$image_name));
            $data->image = $image_name;
        }
        $data->save();

        flash()->addSuccess('package Updateed Successfully!');
        return redirect()->route('admin.package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        if($package == true){

           if ($package->image != null) {
                $old_img = public_path('uploads/package/'.$package->image);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
           }

            $package->delete();
            return response()->json($package);
        }

        return response()->json($package);
    }
    public function imageRemove($id){
        $item = Package::findOrFail($id);
        if($item->image != null){
            $old_img = public_path('uploads/package/'.$item->image);
            if (file_exists($old_img)) {
                unlink($old_img);
            }
        }
        $item->image = null;
        $item->save();
        return response()->json($item);
    }
}
