<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    use RowIndex;

    public function index(){
        $pageTitle = 'Product Categories';

        if (request()->ajax()) {
            $data = Category::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('image', function ($row) {
                    if($row->image != null){
                        $img = asset('uploads/category/'.$row->image);
                    }
                    else{
                        $img = asset('uploads/category/'.$row->image);
                    }
                    $html = '<div class="text-center" uk-lightbox><a href="'.$img.'">
                        <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="'. $img .'" alt="">
                    </a></div>';
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<button onclick="edit('.$row->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $btn1.$btn2;
                })
                ->rawColumns(['action', 'image', 'sl'])
                ->make(true);
        }
        return view('admin.page.categories', compact('pageTitle'));
    }
    public function store(Request $request){

        $data = $request->validate([
            'category_name' => ['required', 'min: 3', 'max:80'],
            'slug' => ['required','min: 3', 'max:100','unique:categories'],
            'image' => ['nullable'],
        ]);

        $slug = Str::slug($request->slug, '-').'-'.rand(1,500);

        $data = new Category();
        if ($request->hasFIle('image')){
            $image = $request->file('image');
            $file_name = $slug.'.'.$image->getclientoriginalextension();

            Image::make($image)->resize(370, 395)->save(public_path('uploads/category/'.$file_name));

            $data->image = $file_name;
        }

        $data->category_name = $request->category_name;
        $data->slug = $slug;
        $data->save();



        return response()->json($data);
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
    public function update(Request $request, $id){
        $data = $request->validate([
            'id' => ['required'],
            'category_name' => ['required', 'min: 3', 'max:80'],
            'image' => ['nullable'],
        ]);
        $data = Category::findOrFail($id);
        $data->category_name = $request->category_name;
        if ($request->hasFIle('image')){
            $old_img = public_path('uploads/category/'.$data->image);
            if($data->image != null){
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }
            $image = $request->file('image');
            $file_name = $data->slug.'.'.$image->getclientoriginalextension();
            Image::make($image)->resize(370, 395)->save(public_path('uploads/category/'.$file_name));
            $data->image = $file_name;
        }
        $data->save();
        return response()->json($data);
    }

    public function destroy($id){
        $check = SubCategory::where('category_id', $id)->first();
        if($check == false){
            $category = Category::findOrFail($id);
            if($category == true){
                $category->delete();
            }
            return response()->json($category);
        }
        else{
            return response()->json('data_have');
        }
    }
}
