<?php

namespace App\Http\Controllers\User;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\AgentCheckRole;
use App\Http\Requests\Rules\CheckBirthDay;
use App\Http\Requests\Rules\ReferCheckRole;
use App\Http\Requests\Rules\UsernameCheckRole;
use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = 'User List';
        if (request()->ajax()) {
            $data = User::where('agent', auth()->user()->username)->where('type', Constant::USER_TYPE['user']);
            $dataCollection = $data->orderBy('id', 'DESC');
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('status', function ($row) {
                    $html = '';
                    if($row->status == Constant::USER_STATUS['active']){
                        $html = 'ACTIVE';
                    }
                    else{
                        $html = 'DEACTIVE';
                    }
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="'.route('admin.user.edit', $row->id).'" class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></a>';
                    $btn2 = '<button onclick="destroy('. $row->id .')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $btn1;
                })
                ->rawColumns(['action', 'sl', 'status'])
                ->make(true);
        }
        return view('user.page.clients.index', compact('pageTitle'));
    }
    public function create(){
        $username = 'AYUR'.rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).User::orderBy('id', 'DESC')->first()->id;
        $pageTitle = 'User Create';
        $countries = Country::all();
        return view('user.page.clients.create', compact('pageTitle', 'username', 'countries'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:60', 'unique:'.User::class, new UsernameCheckRole],
            'email' => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class, 'max:255'],
            'nid_no' => ['required', 'unique:'.User::class],
            'gender' => ['required'],
            'birthday' => ['required', new CheckBirthDay],
            'country' => ['required'],
            'states' => ['required'],
            'tele_code' => ['required'],
            'phone' => ['required', 'numeric', 'unique:'.User::class],
            'refer' => ['required', 'string', 'max:60', new ReferCheckRole],
            'agent' => ['required', 'string', 'max:60', new AgentCheckRole],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->tele_code.$request->phone,
            'refer' => $request->refer,
            'agent' => $request->agent,
            'email' => $request->email,
            'nid_no' => $request->nid_no,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'country' => $request->country,
            'states' => $request->states,
            'password' => Hash::make($request->password),
            'show_password' => $request->password,
            'status' => Constant::USER_STATUS['active'],
            'type' => Constant::USER_TYPE['user']
        ]);

        if($user){
            return redirect()->route('user.package.purchase.create', $user->id)->with('success', 'User Created Successfully');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
