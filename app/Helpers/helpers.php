<?php

use App\Models\Product;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Support\Facades\Auth;

function companyInfo()
{
    return App\Models\ComapanyInfo::findOrFail(1);
}

function category($id)
{
    return App\Models\Category::findOrFail($id);
}
function categories()
{
    return App\Models\Category::all();
}

function contacts()
{
    return App\Models\Contact::all();
}

function contactus()
{
    return App\Models\Contact::find(1);
}

function product_count_for_cat_id($cat_id)
{
    return App\Models\Product::where('category_id', $cat_id)->get()->count();
}
function ProductsByCategory($cat_id)
{
    return App\Models\Product::where('category_id', $cat_id)->orderBy('id', 'desc')->take(12)->get();
}
function ProductsByCategory2($cat_id)
{
    return App\Models\Product::where('category_id', $cat_id)->orderBy('id', 'desc')->take(24)->get();
}

function currency()
{
    $user = auth()->user()->countryInfo;
    $data = [
        'name' => $user->currency_name,
        'symble' => $user->currency_symbol
    ];
    return $data;
}

function available_balance()
{
    return App\Helpers\Traits\Balance::available_balance();
}
function available_point()
{
    return App\Helpers\Traits\Balance::available_point();
}

function deposit_balance()
{
    return App\Helpers\Traits\Balance::deposit_balance();
}
function total_purchase_amount()
{
    return App\Helpers\Traits\Balance::total_purchase_amount();
}
function withdraw_amount($transaction_type)
{
    return App\Helpers\Traits\Balance::withdraw_amount($transaction_type);
}
function company_total_sell_point()
{
    return App\Helpers\Traits\Balance::company_total_sell_point();
}

function agent_package_stock($package_id, $username, $user_id)
{
    return App\Helpers\Traits\StockTrait::agent_package_stock($package_id, $username, $user_id);
}
function agent_product_stock($product_id, $username, $user_id)
{
    return App\Helpers\Traits\StockTrait::agent_product_stock($product_id, $username, $user_id);
}

function zero($zero)
{
    $value = 6 - strlen($zero);
    if ($value == 5) {
        return '00000' . $zero;
    } elseif ($value == 4) {
        return '0000' . $zero;
    } elseif ($value == 3) {
        return '000' . $zero;
    } elseif ($value == 2) {
        return '00' . $zero;
    } elseif ($value == 1) {
        return '0' . $zero;
    }
}

function product($id)
{
    return App\Models\Product::find($id);
}
function package($id)
{
    return App\Models\Package::find($id);
}

function allPostCount()
{
    return App\Models\Product::count() ?? 0;
}
function allPostCountByCat($id)
{
    return App\Models\Product::where('category_id', $id)->count() ?? 0;
}
function allThanaByCat($id)
{
    $products = Product::where('category_id', $id)->get();
    $upazilaIds = $products->pluck('upazila_id')->unique();
    $upazilas = Upazila::whereIn('id', $upazilaIds)->get();
    return $upazilas;
}

