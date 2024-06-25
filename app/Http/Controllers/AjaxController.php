<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rank;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\User;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\PreDec;

class AjaxController extends Controller
{
    public function get_category(){
        $data = Category::all();
        return response()->json($data);
    }
    public function get_subcategory($id){
        $data = SubCategory::where('category_id', $id)->get();
        return response()->json($data);
    }
    public function get_rank(){
        $data = Rank::all();
        return response()->json($data);
    }

    public function username_check(string $username){
        $user = User::where('username', $username)->first();
        if($user == true){
            return response()->json('yes');
        }
        return response()->json('no');
    }
    public function refer_username(string $username){
        $user = User::where('username', $username)->where('type', Constant::USER_TYPE['user'])->where('status', Constant::USER_STATUS['active'])->first();
        if($user == true){
            return response()->json($user->name);
        }
        return response()->json('no');
    }
    public function agent_username(string $username){
        $agent = User::where('username', $username)->where('type', Constant::USER_TYPE['agent'])->where('status', Constant::USER_STATUS['active'])->first();
        if($agent == true){
            return response()->json($agent->name);
        }
        return response()->json('no');
    }

    public function getUsers(){
        $data = User::where('status', Constant::USER_STATUS['active'])->where('type', Constant::USER_TYPE['user'])->get();
        return response()->json($data);
    }

    public function get_states($id){
        $data = State::where('country_id', $id)->get();
        return response()->json($data);
    }

    public function get_tele_code($id){
        $data = State::find($id);
        return response()->json($data->tele_code);
    }
    public function getDistrictByDivision($id){
        $data = District::where('division_id', $id)->get();
        return response()->json($data);
    }
    public function getUpazilaByDistrict($id){
        $data = Upazila::where('district_id', $id)->get();
        return response()->json($data);
    }
    // public function getProduct($id){
    //     $data = Product::where('category_id', $id)->get();
    //     return response()->json($data);
    // }
}
