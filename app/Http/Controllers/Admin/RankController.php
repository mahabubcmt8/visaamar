<?php
//
//namespace App\Http\Controllers\Admin;
//
//use App\Helpers\Constant;
//use App\Helpers\Traits\RankCalculationTrait;
//use App\Helpers\Traits\RowIndex;
//use App\Http\Controllers\Controller;
//use App\Models\Category;
//use App\Models\Rank;
//use App\Models\Rank2;
//use App\Models\User;
//use Illuminate\Http\Request;
//use Yajra\DataTables\Facades\DataTables;
//
//class RankController extends Controller
//{
//    use RowIndex, RankCalculationTrait;
//    public function index(){
//        $pageTitle = 'Rank List';
//
//        if (request()->ajax()) {
//            $data = Rank::orderBy('id', 'ASC');
//
//            $dataCollection = $data;
//            return DataTables::of($dataCollection)
//                ->addColumn('sl', function ($row) {
//                    return $this->dt_index($row);
//                })
//
//                ->addColumn('action', function ($row) {
//                    $btn1 = '<button onclick="edit('.$row->id.');" type="button" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
//                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
//                    return $btn1;
//                })
//                ->rawColumns(['action', 'sl'])
//                ->make(true);
//        }
//        return view('admin.page.rank.index', compact('pageTitle'));
//    }
//
//    public function store(Request $request){
//        $data = $request->validate([
//            'name' => ['required'],
//            'ap' => ['required'],
//            'group_sales' => ['required'],
//            'commission' => ['required'],
//        ]);
//
//        $data = new Rank;
//        $data->name = $request->name;
//        $data->ap = $request->ap;
//        $data->group_sales = $request->group_sales;
//        $data->commission = $request->commission;
//        $data->save();
//
//        return response()->json($data);
//    }
//
//    public function edit($id){
//        return Rank::findOrFail($id);
//    }
//
//    public function update(Request $request, $id){
//        $data = $request->validate([
//            'name' => ['required'],
//            'ap' => ['required'],
//            'group_sales' => ['required'],
//            'commission' => ['required'],
//        ]);
//
//        $data = Rank::findOrFail($id);
//        $data->name = $request->name;
//        $data->ap = $request->ap;
//        $data->group_sales = $request->group_sales;
//        $data->commission = $request->commission;
//        $data->save();
//
//        return response()->json($data);
//    }
//
//    public function destroy($id){
//        $rank = Rank::findOrFail($id);
//        $rank->delete();
//        return $rank;
//    }
//
//    public function rankUsers(){
//        $pageTitle = 'Rank User List';
//        if (request()->ajax()) {
//
//            $data = User::with(['rank' => function ($query) {
//                $query->orderBy('team_point', 'DESC');
//            }])
//            ->has('rank')->where('type', Constant::USER_TYPE['user']);
//
//            $dataCollection = $data;
//            return DataTables::of($dataCollection)
//                ->addColumn('sl', function ($row) {
//                    return $this->dt_index($row);
//                })
//                ->addColumn('rank', function ($row) {
//                    return $row->rank->rankInfo->name;
//                })
//                ->addColumn('team_sales', function ($row) {
//                    return $row->rank->team_sales;
//                })
//                ->addColumn('team_point', function ($row) {
//                    return $row->rank->team_point;
//                })
//                ->addColumn('self_sales', function ($row) {
//                    return $row->rank->self_sales;
//                })
//                ->addColumn('self_point', function ($row) {
//                    return $row->rank->self_point;
//                })
//                ->addColumn('self_bonus', function ($row) {
//                    return $row->rank->self_bonus;
//                })
//                ->addColumn('team_bonus', function ($row) {
//                    return $row->rank->team_bonus;
//                })
//
//                ->rawColumns(['sl', 'rank', 'team_sales', 'team_point', 'self_sales', 'self_point', 'self_bonus', 'team_bonus'])
//                ->make(true);
//        }
//
//
//        return view('admin.page.rank.rank-user', compact('pageTitle'));
//    }
//
//    public function rankGive(string $rank_name, string $username){
//        $user = User::with('purchase', 'referrals', 'rank')->where("status", 0)->get();
//
//        $data = $this->setKey($user);
//
//        $usr = $data[$username];
//        $team_total = $this->countGeneration($data, $username);
//
//        $user_deposit = $usr->purchase->sum('deb_amount');
//        $user_point = ($usr->purchase->sum('cred_point') - $usr->purchase->sum('deb_point'));
//        $total_team_sales = $team_total['total'];
//        $total_team_point = $team_total['point'];
//
//        $self_bonus = 0;
//        $team_bonus = 0;
//
//        switch (true) {
//            case $rank_name === 'customer':
//                $self_bonus = 10;
//                $team_bonus = 0;
//            break;
//            case $rank_name === 'distributor':
//                $self_bonus = 12;
//                $team_bonus = 2;
//            break;
//            case $rank_name === 'leader':
//                $self_bonus = 15;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'sales_manager':
//                $self_bonus = 18;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'silver_director':
//                $self_bonus = 21;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'gold_director':
//                $self_bonus = 24;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'platinum_director':
//                $self_bonus = 27;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'crown_director':
//                $self_bonus = 30;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'ruby_director':
//                $self_bonus = 33;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'diamond_director':
//                $self_bonus = 36;
//                $team_bonus = 3;
//            break;
//            case $rank_name === 'star_ambassador':
//                $self_bonus = 38;
//                $team_bonus = 2;
//            break;
//            case $rank_name === 'brand_ambassador':
//                $self_bonus = 40;
//                $team_bonus = 2;
//            break;
//            default:
//                $self_bonus = 0;
//                $team_bonus = 0;
//            break;
//        }
//
//        $rank = new Rank2;
//        $rank->rank_name = $rank_name;
//        $rank->username = $username;
//        $rank->team_sales = $total_team_sales;
//        $rank->team_point = $total_team_point;
//        $rank->team_earning = 0;
//        $rank->self_sales = $user_deposit;
//        $rank->self_point = $user_point;
//        $rank->self_earning = 0;
//        $rank->self_bonus = $self_bonus;
//        $rank->team_bonus = $team_bonus;
//        $rank->save();
//
//        return $rank;
//    }
//}
