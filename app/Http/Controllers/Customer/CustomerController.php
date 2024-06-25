<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\CookieCheckRule;
use App\Models\Cart;
use App\Models\ClubBonusDetails;
use App\Models\Country;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(){
        $pageTitle = 'Customer Dashboard';
        $club_bonus = ClubBonusDetails::where('deleted_at',null)->get();
        return view('customer.home', compact('pageTitle','club_bonus'));
    }
}
