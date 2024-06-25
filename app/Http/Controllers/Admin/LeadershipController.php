<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Leadership;
use App\Models\Rank;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeadershipController extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = 'Leadership List';
        $rank = Rank::all();

        if (request()->ajax()) {
            $data = Leadership::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('rank', function ($row) {
                    return $row->rank->name;
                })
                
                ->addColumn('action', function ($row) {
                    // $btn1 = '<button onclick="edit('.$row->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $btn2;
                })
                ->rawColumns(['action', 'sl', 'rank'])
                ->make(true);
        }
        return view('admin.page.leadership.index', compact('pageTitle', 'rank'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'rank' => ['required'],
            'lavel_1' => ['required'],
            'lavel_2' => ['required'],
            'lavel_3' => ['required'],
            'lavel_4' => ['required'],
            'lavel_5' => ['required'],
            'lavel_6' => ['required'],
            'lavel_7' => ['required'],
        ]);
        
        $data = new Leadership;
        $data->rank_id = $request->rank;
        $data->lavel_1 = $request->lavel_1;
        $data->lavel_2 = $request->lavel_2;
        $data->lavel_3 = $request->lavel_3;
        $data->lavel_4 = $request->lavel_4;
        $data->lavel_5 = $request->lavel_5;
        $data->lavel_6 = $request->lavel_6;
        $data->lavel_7 = $request->lavel_7;
        $data->save();

        return response()->json($data);
    }

    public function edit($id){
        return Leadership::findOrFail($id);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'rank' => ['required'],
            'lavel_1' => ['required'],
            'lavel_2' => ['required'],
            'lavel_3' => ['required'],
            'lavel_4' => ['required'],
            'lavel_5' => ['required'],
            'lavel_6' => ['required'],
            'lavel_7' => ['required'],
        ]);
        
        $data = Leadership::findOrFail($id);
        $data->rank_id = $request->rank;
        $data->lavel_1 = $request->lavel_1;
        $data->lavel_2 = $request->lavel_2;
        $data->lavel_3 = $request->lavel_3;
        $data->lavel_4 = $request->lavel_4;
        $data->lavel_5 = $request->lavel_5;
        $data->lavel_6 = $request->lavel_6;
        $data->lavel_7 = $request->lavel_7;
        $data->save();

        return response()->json($data);
    }

    public function destroy($id){
        $rank = Leadership::findOrFail($id);
        $rank->delete();
        return $rank;
    }
}
