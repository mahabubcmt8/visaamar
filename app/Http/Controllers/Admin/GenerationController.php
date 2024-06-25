<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generation;
use Generator;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $pageTitle = 'Generation';
        $data=[
            'title'=>'Generation',
        ];

        if (request()->ajax()) {
            $get = Generation::query();
            return DataTables::of($get)
                ->addIndexColumn()
                ->addColumn('action', function ($get) use ($data) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    // $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.page.generation.index',compact('data','pageTitle'));
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
            'name'=>"required|max:200|min:1|unique:generations,name",
            'serial'=>"required|max:20|min:1|unique:generations,serial",
            'comission'=>"required|max:20|min:1",
        ]);
            $generation = Generation::create([
                'name' => $request->name,
                'serial' => $request->serial,
                'comission' => $request->comission,
                'status' => Constant::GENERATION_STATUS['active']
            ]);

            return response()->json($generation);
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
        return response()->json(Generation::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name'=>"required|max:200|min:1|unique:generations,name,".$id,
            'serial'=>"required|max:20|min:1|unique:generations,serial,".$id,
            'comission'=>"required|max:20|min:1",
        ]);
        if($validator->passes()){
            $generation = Generation::where('id',$id)->update([
                'name' => $request->name,
                'serial' => $request->serial,
                'comission' => $request->comission,
                'status' => Constant::GENERATION_STATUS['active']
            ]);

            return response()->json(['message' => 'Generation Updated Success']);
        }
        return response()->json(['error'=>$validator->getMessageBag()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Generation::findOrFail($id)->delete();
        return response()->json(['message'=>"Deleted Success"]);
    }
}
