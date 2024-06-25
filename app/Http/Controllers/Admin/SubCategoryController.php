<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Traits\RowIndex;
use App\Models\Categroy;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class SubCategoryController extends Controller
{

    use RowIndex;

    public function index(){
        $pageTitle = 'Product Sub Categories';

        if (request()->ajax()) {
            $data = SubCategory::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('sub_category', function ($row) {
                   return $row->subcategory;
                })
                ->addColumn('category', function ($row) {
                    return $row->category->category_name;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<button onclick="edit('.$row->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $btn1.$btn2;
                })
                ->rawColumns(['action', 'category', 'sub_category', 'sl'])
                ->make(true);
        }
        return view('admin.page.sub-category', compact('pageTitle'));
    }
    public function store(Request $request){
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory' => ['required', 'min: 3', 'max:80'],
            'slug' => ['required','min: 3', 'max:100','unique:sub_categories'],
        ]);

        $data = new SubCategory;
        $data->category_id = $request->category_id;
        $data->subcategory = $request->subcategory;
        $data->slug = Str::slug($request->slug, '-').'-'.rand(1,500);
        $data->save();

        return response()->json($data);

    }
    public function destroy($id){
        // $check = Product::where('brand_id', $id)->first();
        // if($check == false){
        //     $data = SubCategory::findOrFail($id);
        //     if($data == true){
        //         $data->delete();
        //     }
        //     return response()->json($data);
        // }
        // else{
        //     return response()->json('data_have');
        // }
        $data = SubCategory::findOrFail($id);
        if($data == true){
            $data->delete();
        }
        return response()->json($data);
    }

    public function edit($id){
        $data = SubCategory::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'category_id' => ['required'],
            'subcategory' => ['required', 'min: 3', 'max:80'],
        ]);

        $data = SubCategory::findOrFail($id);
        $data->category_id = $request->category_id;
        $data->subcategory = $request->subcategory;
        $data->save();
        return response()->json($data);
    }
}
