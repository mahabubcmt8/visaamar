<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Country';
        $data=[
            'title'=>'Country',
        ];

        if (request()->ajax()) {
            $get = Country::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name ?? '';
                })
                ->addColumn('currency_name', function ($row) {
                    return $row->currency_name ?? '';
                })
                ->addColumn('currency_symbol', function ($row) {
                    return $row->currency_symbol ?? '';
                })
                ->addColumn('timezone', function ($row) {
                    return $row->timezone ?? '';
                })
                ->addColumn('action', function ($get) use ($data) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.page.country.index',compact('data','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'country_name' => ['required'],
            'currency_name' => ['required'],
            'currency_symbol' => ['required'],
            'timezone' => ['required'],
        ]);

        $data = new Country;
        $data->name = $request->country_name;
        $data->currency_name = $request->currency_name;
        $data->currency_symbol = $request->currency_symbol;
        $data->timezone = $request->timezone;
        $data->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Country::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'country_name' => ['required'],
            'currency_name' => ['required'],
            'currency_symbol' => ['required'],
            'timezone' => ['required'],
        ]);

        $data = Country::findOrFail($id);
        $data->name = $request->country_name;
        $data->currency_name = $request->currency_name;
        $data->currency_symbol = $request->currency_symbol;
        $data->timezone = $request->timezone;

        $data->save();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return $country;
    }
}
