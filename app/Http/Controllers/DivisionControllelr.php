<?php

namespace App\Http\Controllers;

use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Http\Request;
use Termwind\Components\Div;

class DivisionControllelr extends Controller
{
    public function index()
    {
        $pageTitle = 'Division';
        $divisionmanage = Division::all();
        return view('admin.page.division.index', compact('pageTitle', 'divisionmanage'));
    }
    public function create()
    {
        $pageTitle = 'Create Division';
        return view('admin.page.division.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:' . Division::class],
            'bn_name' => ['required', 'unique:' . Division::class],
        ]);

        $data = new Division;
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();

        return redirect()->route('admin.settings.division.index')->with('success', 'Product list create successfully');
    }

    public function edit($id)
    {
        $pageTitle = 'Edit Division';
        $divisionedit = Division::findOrFail($id);
        return view('admin.page.division.edit', compact('pageTitle', 'divisionedit'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => ['required'],
            'bn_name' => ['required' ],
        ]);

        $data = Division::findOrFail($id);
        $data->name = $request->name;
        $data->bn_name = $request->bn_name;
        $data->save();

        return redirect()->route('admin.settings.division.index')->with('success', 'Division list update successfully.');
    }

    public function destroy($id)
    {
//        Division::deleteDivision($id);
//        return back()->with('success', 'Product list delete successfully.');

        $check = District::where('division_id', $id)->first();
        if($check == false){
            $division = Division::findOrFail($id);
            if($division == true){
                $division->delete();
            }
            return redirect()->route('admin.settings.division.index')->with('success', 'Division list deleted ');

        }
        else{
//            return response()->json('data_have');
            return redirect()->route('admin.settings.division.index')->with('error', 'Division can not be deleted ');

        }

    }
}
