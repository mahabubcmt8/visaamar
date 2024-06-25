<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'State';
        $data=[
            'title'=>'State',
        ];

        $countries = Country::get();

        if (request()->ajax()) {
            $get = State::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name ?? '';
                })
                ->addColumn('postal_code', function ($row) {
                    return $row->postal_code ?? '';
                })
                ->addColumn('tele_code', function ($row) {
                    return $row->tele_code ?? '';
                })
                ->addColumn('country_id', function ($row) {
                    return $row->country->name ?? '';
                })
                ->addColumn('action', function ($get) use ($data) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.page.state.index',compact('data','pageTitle','countries'));
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
            'country_id' => ['required'],
            'state_name' => ['required'],
            'postal_code' => ['nullable'],
            'tele_code' => ['required'],
        ]);

        $data = new State;
        $data->country_id = $request->country_id;
        $data->name = $request->state_name;
        $data->postal_code = $request->postal_code;
        $data->tele_code = $request->tele_code;
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
        return State::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'country_id' => ['required'],
            'state_name' => ['required'],
            'postal_code' => ['nullable'],
            'tele_code' => ['required'],
        ]);

        $data = State::findOrFail($id);
        $data->country_id = $request->country_id;
        $data->name = $request->state_name;
        $data->postal_code = $request->postal_code;
        $data->tele_code = $request->tele_code;

        $data->save();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        return $state;
    }
}
