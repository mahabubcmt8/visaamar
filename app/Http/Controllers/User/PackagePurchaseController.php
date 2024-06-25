<?php

namespace App\Http\Controllers\User;

use App\Helpers\Constant;
use App\Helpers\Traits\StockTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\CheckUserRoute;
use App\Http\Requests\Rules\CookieCheckRule;
use App\Http\Requests\Rules\CookieCheckRuleForPackage;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PackagePurchaseController extends Controller
{
    use StockTrait;
    public function packagePurchase($id){
        $client = User::findOrFail($id);
        $pageTitle = 'Package Purchase For Clients';
        $packages = Package::where('stock_status', 0)->where('status', 0)->get();
        return view('user.page.package.purchase', compact('pageTitle', 'packages', 'client'));
    }

    public function packagePurchaseStore(Request $request){
        $data = Validator::make($request->all(),[
            'cookie_id' => ["required", new CookieCheckRuleForPackage],
            'client_id' => ["required", new CheckUserRoute],
        ]);

        // Cookie::queue(Cookie::forget('package_cookie_id'));
        // return redirect()->route('user.home')->with('success', 'Purchase Successfully Done.');

        if($data->passes()){
            $cookie_id = request()->cookie('package_cookie_id');
            $cartInfo = DB::table('carts')
                ->join('packages', 'carts.product_id', '=', 'packages.id')
                ->where('carts.cookie_id', '=', $cookie_id)
                ->where('carts.client_id', '=', $request->client_id)
                ->select(
                    DB::raw('SUM(carts.quantity * packages.price) as total_amount'),
                    DB::raw('SUM(carts.quantity * packages.point) as total_point')
                )
                ->first();


            $client = User::find($request->client_id);

            $invoice = new Invoice;
            $invoice->user_id = $client->id;
            $invoice->agent_id = Auth::user()->agent;
            $invoice->refer_id = $client->refer;
            $invoice->total_point = $cartInfo->total_point;
            $invoice->sub_total = $cartInfo->total_amount;
            $invoice->bill_amount = $cartInfo->total_amount;
            $invoice->type = Constant::ORDER_TYPE['customer_packege'];
            $invoice->status = Constant::STATUS['pending'];
            $invoice->order_status = Constant::ORDER_STATUS['placed'];
            $invoice->cookie_id = $cookie_id;
            $invoice->date = time();
            $invoice->save();

            $cartItems = Cart::where('cookie_id', $cookie_id)->get();
            foreach($cartItems as $cart){
                $package = Package::find($cart->product_id);
                $item = new InvoiceItem;
                $item->invoice_id = $invoice->id;
                $item->package_id = $package->id;
                $item->point = $package->point;
                $item->qty = $cart->quantity;
                $item->price = $package->price;
                $item->offer_price = 0;
                $item->save();
            }

            Cookie::queue(Cookie::forget('package_cookie_id'));
            return redirect()->back()->with('success', 'Client Package Order Submited Successfully!');
        }

        if ($data->fails()) {
            return redirect()->back()->with('error', $data->errors()->all());
        }

        return redirect()->back()->with('error', 'Add To Cart Faild! Please Try Again');
    }

}
