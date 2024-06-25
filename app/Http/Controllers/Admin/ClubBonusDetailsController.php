<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClubBonusDetails;
use App\Models\ClubBonusDetailsAsset;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClubBonusDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pageTitle = 'Club Bonus Details';
        $data=[
            'title'=>'Club Bonus Details',
        ];

        if (request()->ajax()) {
            $get = ClubBonusDetails::query();
            return DataTables::of($get)
                ->addIndexColumn()

                ->addColumn('name', function ($get) use ($data) {
                    return $get->name;
                })
                ->addColumn('assets', function ($get) use ($data) {
                    $assets = ClubBonusDetailsAsset::where('club_id', $get->id)->get();
                    $button = '<div class="d-flex justify-content-center">';
                    $button .= '<table class="table table-bordered mb-0"><thead><tr><td>Rank</td><td>Bonus</td></tr></thead><tbody>';
                    foreach($assets as $asset) {
                        $button .= '<tr><td>'.$asset->rank->name.'</td><td>'.$asset->bonus.'</td></tr>';
                    }
                    $button .= '<tbody></table></div>';
                    return $button;
                })
                ->addColumn('action', function ($get) use ($data) {
                    $button = '<button onclick="edit('.$get->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button onclick="destroy('. $get->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action','name','assets'])
                ->make(true);
        }
        return view('admin.page.club_bonus_details.index',compact('data','pageTitle'));
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
            'name' => ['required'],
        ]);
       $data = new ClubBonusDetails();
       $data->name = $request->name;
       $data->save();

       $asset_items = json_decode($request->tableData, true);

        if ($data) {
            foreach ($asset_items as $item) {
                $newAssetItem = [
                    'club_id' => $data->id,
                    'rank_id' => $item['rank_id'],
                    'bonus' => $item['bonus'],
                ];
                ClubBonusDetailsAsset::create($newAssetItem);
            }
        }
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
        $data = ClubBonusDetails::findOrFail($id);
        $data['asset_items'] = ClubBonusDetailsAsset::with(['rank'])->where('club_id', $data->id)->get();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);
       $data = ClubBonusDetails::findOrFail($id);
       $data->name = $request->name;
       $data->save();

       $asset_items = json_decode($request->tableData, true);

        if ($data) {
            foreach ($asset_items as $item) {
                $asset_id = $item['asset_id'] ?? '';
                if ($asset_id) {
                    $club_bonus_details = ClubBonusDetailsAsset::findOrFail($asset_id);
                    $club_bonus_details->update([
                        'rank_id' => $item['rank_id'],
                        'bonus' => $item['bonus'],
                    ]);
                }else{
                    $newAssetItem = [
                        'club_id' => $data->id,
                        'rank_id' => $item['rank_id'],
                        'bonus' => $item['bonus'],
                    ];
                    ClubBonusDetailsAsset::create($newAssetItem);
                }

            }
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $club = ClubBonusDetails::findOrFail($id);
        $data = ClubBonusDetailsAsset::where('club_id',$id)->get();
        if ($data) {
            foreach ($data as $row){
                $row->delete();
            }
        }
        $club->delete();

        return $club;
    }
}
