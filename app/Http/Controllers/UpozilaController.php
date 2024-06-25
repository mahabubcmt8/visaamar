<?php

namespace App\Http\Controllers;

use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;

class UpozilaController extends Controller
{
    public function index()
    {
        $pageTitle = 'Upazila';
        $upazilaselect = Upazila::all();
        return view('admin.page.upazila.index', compact('pageTitle', 'upazilaselect'));
    }


    public function create(){

//        $upazilas = Upazila::all();
        $districtlst = District::all();
        $divisionlst = Division::all();

        $pageTitle = 'Create Upazila';
        return view('admin.page.upazila.create', compact('pageTitle', 'districtlst', 'divisionlst'));
    }

    public function getDistricByDivisiion()
    {
        $id = $_GET['id'];
        $district = District::where('division_id', 'id')->get();
        return response()->json(District::where('division_id' , $id)->get());
    }

    public function store(Request $request)
    {

        $request->validate([
            'district_id' => ['required'],
            'name' => ['required' , 'unique:' . District::class],
            'bn_name' => ['required', 'unique:' . District::class],
        ]);

        $data = new Upazila();
        $data->district_id = $request->district_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();
        
//        District::newDistrict($request);
        return redirect()->route('admin.settings.upazila.index')->with('success', 'Upazila list create successfully');
    }


    public function edit($id)
    {

        $pageTitle = 'Edit Upazila';
        $dataupozila = Upazila::findOrFail($id);
        $divisions = Division::all();
        $districts = District::all();

        return view('admin.page.upazila.edit', compact('pageTitle','divisions', 'districts', 'dataupozila'));
    }

    public function update(Request $request, $id)
    {
// return $request;
        $request->validate([

            'district_id' => ['required'],
            'name' => ['required' , 'unique:' . District::class],
            'bn_name' => ['required', 'unique:' . District::class],
        ]);


        $data =  Upazila::findOrFail($id);
        $data->district_id = $request->district_id;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();




        return redirect()->route('admin.settings.upazila.index')->with('success', 'Upazila list update successfully.');
    }

    public function destroy($id)
    {
        $check = Upazila::find($id)->delete();
        return redirect()->route('admin.settings.upazila.index')->with('success', 'Upazila list deleted successfully.');

//        if($check == false){
//            $district = District::findOrFail($id);
//            if($district == true){
//                $district->delete();
//            }
//            return redirect()->route('admin.district.index')->with('success', 'District list deleted ');
//        }
//        else{
////            return response()->json('data_have');
//            return redirect()->route('admin.district.index')->with('error', 'District can not be deleted ');
//
//        }

    }


}
