<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\AgentCheckRole;
use App\Http\Requests\Rules\CheckBirthDay;
use App\Http\Requests\Rules\ReferCheckRole;
use App\Http\Requests\Rules\UsernameCheckRole;
use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    use RowIndex;
    public function index() {
        if (request()->has('agent_list')){
            $pageTitle = 'Agent List';
        }
        else if (request()->has('blocked')){
            $pageTitle = 'Blocked User List';
        }
        else{
            $pageTitle = 'Active User List';
        }

        if (request()->ajax()) {
            if (request()->has('blocked')) {
                $data = User::where('status', Constant::USER_STATUS['deactive']);
            }
            else{

                $data = User::where('status', Constant::USER_STATUS['active']);
            }

            if(request()->has('agent_list')){
                $data = $data->where('type', Constant::USER_TYPE['agent']);
            }
            else{
                $data = $data->where('type', Constant::USER_TYPE['user']);
            }

            $dataCollection = $data->orderBy('id', 'DESC');
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('type', function ($row) {
                    $html = '';
                    if($row->type == Constant::USER_TYPE['user']){
                        $html = 'USER';
                    }
                    else{
                        $html = 'AGENT';
                    }
                    return $html;
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
                ->rawColumns(['action', 'sl', 'type', 'status'])
                ->make(true);
        }

        return view('admin.page.user.user-list', compact('pageTitle'));
    }

    public function create() {

        if(request()->has('agent')){
            $pageTitle = 'User Agent';
        }
        else{
            $pageTitle = 'User Create';
        }
        $user = '';
        $countries = Country::all();
        $username = 'AYUR'.rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).User::orderBy('id', 'DESC')->first()->id;
        return view('admin.page.user.create', compact('pageTitle', 'user', 'countries', 'username'));
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
            'status' => ['required'],
            'type' => ['required'],
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
            'status' => $request->status,
            'type' => $request->type
        ]);


        if($user){
            flash()->addSuccess('User Create Successfull.');
            return redirect()->route('admin.user.list');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function edit($id){
        $pageTitle = 'User Edit';
        $countries = Country::all();
        $user = User::findOrFail($id);
        return view('admin.page.user.create', compact('pageTitle', 'user', 'countries'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'nid_no' => ['required'],
            'gender' => ['required'],
            'birthday' => ['required', new CheckBirthDay],
            'country' => ['required'],
            'states' => ['required'],
            'tele_code' => ['required'],
            'phone' => ['required', 'numeric'],
            'refer' => ['required', 'string', 'max:60', new ReferCheckRole],
            'agent' => ['required', 'string', 'max:60', new AgentCheckRole],
            'password' => ['required', 'confirmed', Password::defaults()],
            'status' => ['required'],
            'type' => ['required'],
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->phone = $request->tele_code.$request->phone;
        $user->refer = $request->refer;
        $user->email = $request->email;

        $user->nid_no = $request->nid_no;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->country = $request->country;
        $user->states = $request->states;

        $user->password = Hash::make($request->password);
        $user->show_password = $request->password;
        $user->status = $request->status;
        $user->type = $request->type;
        $user->save();


        flash()->addSuccess('User Update Successfull.');

        return redirect()->route('admin.user.list');
    }
}
