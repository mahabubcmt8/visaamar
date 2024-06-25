<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Termwind\Components\Div;

class DistrictController extends Controller
{
    public function index()
    {
        $pageTitle = 'District';
        $districtselect = District::all();
        return view('admin.page.district.index', compact('pageTitle', 'districtselect'));
    }

    public function create(){
        $divisions = Division::all();
        $pageTitle = 'Create District';
        return view('admin.page.district.create', compact('pageTitle', 'divisions'));
    }

    public function store(Request $request)
    {
       $request->validate([
            'division_id' => ['required'],
            'name' => ['required' , 'unique:' . Division::class],
           'bn_name' => ['required', 'unique:' . Division::class],
        ]);

        $data = new District();
        $data->division_id = $request->division_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();


//        District::newDistrict($request);
        return redirect()->route('admin.settings.district.index')->with('success', 'District list create successfully');
    }


        public function edit($id)
    {
        $pageTitle = 'Edit District';
        $districtitem = District::findOrFail($id);
        $divisionitem = Division::all();

        return view('admin.page.district.edit', compact('pageTitle','districtitem', 'divisionitem'));
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'division_id' => ['required'],
            'name' => ['required'],
            'bn_name' => ['required' ],
        ]);

        $data = District::findOrFail($id);
        $data->division_id = $request->division_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();

        return redirect()->route('admin.settings.district.index')->with('success', 'District list update successfully.');
    }

    public function destroy($id)
    {
        $check = Upazila::where('district_id', $id)->first();
        if($check == false){
            $district = District::findOrFail($id);
            if($district == true){
                $district->delete();
            }
            return redirect()->route('admin.settings.district.index')->with('success', 'District list deleted ');
        }
        else{
//            return response()->json('data_have');
            return redirect()->route('admin.settings.district.index')->with('error', 'District can not be deleted ');

        }

    }

//    public function update(Request $request, $id)
//    {
//        District::updateDistrict($request, $id);
//        return redirect()->route('admin.district.index')->with('success', 'District list create successfully');
//    }
//    public function destroy($id)
//    {
//        District::deleteDistrict($id);
//        return back()->with('success', 'Sub category info delete successfully.');
//    }
}
