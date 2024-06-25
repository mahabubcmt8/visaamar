<?php

namespace App\Http\Controllers\User;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Helpers\Traits\StockTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\AgentCookieCheckForPackageRule;
use App\Http\Requests\Rules\AgentCookieCheckRule;
use App\Http\Requests\Rules\CookieCheckRule;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AgentStockController extends Controller
{
    use RowIndex, StockTrait;
    public function index(){
        $pageTitle = 'Product Purchase List';
        if (request()->ajax()) {
            $data = Invoice::where('user_id', Auth::user()->id)->where('type', Constant::ORDER_TYPE['agent']);

            if(request()->form_date && request()->to_date){
                $form_date = strtotime(request()->form_date. ' 00:00:01');
                $to_date = strtotime(request()->to_date. ' 23:59:59');
                $data = $data->whereBetween('date',[$form_date, $to_date]);
            }
            else{
                if(request()->form_date){
                    $form_date = strtotime(request()->form_date. ' 00:00:01');
                    $to_date = strtotime(request()->form_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }
                else if(request()->to_date){
                    $form_date = strtotime(request()->to_date. ' 00:00:01');
                    $to_date = strtotime(request()->to_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }
                else{
                    $data = $data;
                }
            }

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('order_id', function ($row) {
                    return zero($row->id);
                })
                ->addColumn('status', function ($row) {
                    return ucwords(array_flip(Constant::ORDER_STATUS)[$row->order_status]);
                })
                ->addColumn('date', function ($row) {
                    $date = date('d M Y', strtotime($row->created_at)).' </br>' .date('h:i:s a', strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('approve_date', function ($row) {
                    if($row->updated_at != $row->created_at){
                        $update = date('d M Y', strtotime($row->updated_at)).' </br>' .date('h:i:s a', strtotime($row->updated_at));
                    }
                    else{
                        $update = 'N/A';
                    }
                    return $update;
                })
                ->rawColumns(['sl','order_id' ,'status', 'date', 'approve_date'])
                ->make(true);
        }
        return view('user.page.purchase.index', compact('pageTitle'));
    }

    public function create(){
        $pageTitle = 'Create Agent Purchase';
        $products = Product::paginate(20);
        return view('user.page.purchase.create', compact('pageTitle', 'products'));
    }

    public function store(Request $request){

        $data = Validator::make($request->all(),[
            'cookie_id' => ["required", new AgentCookieCheckRule],
        ]);

        if($data->passes()){
            $user = Auth::user();
            $cookie_id = request()->cookie('agent_cookie_id');
            $cartInfo = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->where('carts.cookie_id', '=', $cookie_id)
                ->where('carts.user_id', '=', $user->id)
                ->select(
                    DB::raw('SUM(CASE WHEN products.offer_price IS NOT NULL AND products.offer_price != 0 THEN carts.quantity * products.offer_price ELSE carts.quantity * products.price END) as total_amount'),
                    DB::raw('SUM(carts.quantity * products.point) as total_point')
                )
                ->first();

            $balance = available_balance();
            if($balance < $cartInfo->total_amount){
                return redirect()->back()->with("warning", "Insufficient Balance! You have ".number_format($balance, 2)." ".Constant::CURRENCY['name']."  in your account.");
            }

            $invoice = new Invoice;
            $invoice->user_id = $user->id;
            $invoice->total_point = $cartInfo->total_point;
            $invoice->sub_total = $cartInfo->total_amount;
            $invoice->bill_amount = $cartInfo->total_amount;
            $invoice->type = Constant::ORDER_TYPE['agent'];
            $invoice->status = Constant::STATUS['pending'];
            $invoice->order_status = Constant::ORDER_STATUS['pending'];
            $invoice->cookie_id = $cookie_id;
            $invoice->date = time();
            $invoice->save();

            $cartItems = Cart::where('cookie_id', $cookie_id)->where('user_id', $user->id)->get();
            foreach($cartItems as $cart){
                $product = Product::find($cart->product_id);
                $item = new InvoiceItem;
                $item->invoice_id = $invoice->id;
                $item->product_id = $product->id;
                $item->point = $product->point;
                $item->qty = $cart->quantity;
                $item->price = $product->price;
                $item->offer_price = $product->offer_price;
                $item->save();
            }

            Cookie::queue(Cookie::forget('agent_cookie_id'));
            return redirect()->back()->with('success', 'Order Submited Successfully!');
        }

        return redirect()->back()->with('error', 'Add To Cart Faild! Please Try Again');
    }

    public function stockList(){
        $pageTitle = 'Product Stock';
        if (request()->ajax()) {
            $data = Product::where('status', Constant::PRODUCT_STATUS['active']);
            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('product', function ($row) {
                    $img = "https://diamondvalley.com.bd/images/image-not-found.png";
                    if($row->thumbnail != null){
                        $img = asset("uploads/product/".$row->thumbnail);
                    }
                    $html = '<div class="d-flex">
                        <div style="width: 70px; border: 1px solid #ddd; padding: 2px; border-radius: 4px; vertical-align: middle; text-align: center; margin: auto 0px;">
                            <img style="width: 100%; height: 70px" src="'.$img.'" alt="">
                        </div>
                        <div style="margin-left: 10px; text-align: left;">
                            <a target="_bank" href="'.route('product', ['id' => $row->id, 'slug' => $row->slug]).'">
                                <h5 style="font-size: 15px;">'.$row->title.'</h5>
                                <p style="font-size: 13px;" class="my-0">'.$row->category->category_name.'</p>
                                <p style="font-size: 13px;" class="my-0">Regular Price :<span>'.$row->price.'</span></p>
                                <p style="font-size: 13px;" class="my-0">Offer Price : <span>'.$row->offer_price ?? ''.'</span></p>
                            </a>
                        </div>
                    </div>';
                    return $html;
                })
                ->addColumn('purchase', function ($row) {
                    return $this->purchase_qty($row->id, Auth::user()->id);
                })
                ->addColumn('purchase_price', function ($row) {
                    $total_qty = $this->purchase_qty($row->id, Auth::user()->id);
                    $price =  $this->purchase_price($row->id, Auth::user()->id);

                    $total_price_amount =  $total_qty * $price;
                    return $total_price_amount ?? '0';
                })
                ->addColumn('sell', function ($row) {
                    return $this->sell_qty($row->id, Auth::user()->username);
                })
                ->addColumn('stock', function ($row) {
                    return $this->stock($row->id, Auth::user()->username, Auth::user()->id);
                })
                ->rawColumns(['sl','product','purchase','sell','stock'])
                ->make(true);
        }
        return view('user.page.stock.index', compact('pageTitle'));
    }

    public function package_create(){
        $pageTitle = 'Purchase Package';
        $packages = Package::paginate(20);
        return view('user.page.purchase.purchase_package', compact('pageTitle', 'packages'));
    }

    public function package_store(Request $request){
        $data = Validator::make($request->all(),[
            'cookie_id' => ["required", new AgentCookieCheckForPackageRule],
        ]);

        if($data->passes()){
            $user = Auth::user();
            $cookie_id = request()->cookie('agent_package_purchase_cookie_id');
            $cartInfo = DB::table('carts')
                ->join('packages', 'carts.product_id', '=', 'packages.id')
                ->where('carts.cookie_id', '=', $cookie_id)
                ->where('carts.user_id', '=', $user->id)
                ->select(
                    DB::raw('SUM(carts.quantity * packages.price) as total_amount'),
                    DB::raw('SUM(carts.quantity * packages.point) as total_point')
                )
                ->first();


            $balance = available_balance();
            if($balance < $cartInfo->total_amount){
                return redirect()->back()->with("warning", "Insufficient Balance! You have ".number_format($balance, 2)." ".Constant::CURRENCY['name']."  in your account.");
            }

            $invoice = new Invoice;
            $invoice->user_id = $user->id;
            $invoice->total_point = $cartInfo->total_point;
            $invoice->sub_total = $cartInfo->total_amount;
            $invoice->bill_amount = $cartInfo->total_amount;
            $invoice->type = Constant::ORDER_TYPE['agent_packege'];
            $invoice->status = Constant::STATUS['pending'];
            $invoice->order_status = Constant::ORDER_STATUS['pending'];
            $invoice->cookie_id = $cookie_id;
            $invoice->date = time();
            $invoice->save();

            $cartItems = Cart::where('cookie_id', $cookie_id)->where('user_id', $user->id)->get();
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

            Cookie::queue(Cookie::forget('agent_package_purchase_cookie_id'));
            return redirect()->back()->with('success', 'Package Order Submited Successfully!');
        }

        return redirect()->back()->with('error', 'Add To Cart Faild! Please Try Again');
    }

    public function package_index (){
        $pageTitle = 'Package Purchase List';
        if (request()->ajax()) {
            $data = Invoice::where('user_id', Auth::user()->id)->where('type', Constant::ORDER_TYPE['agent_packege']);

            if(request()->form_date && request()->to_date){
                $form_date = strtotime(request()->form_date. ' 00:00:01');
                $to_date = strtotime(request()->to_date. ' 23:59:59');
                $data = $data->whereBetween('date',[$form_date, $to_date]);
            }
            else{
                if(request()->form_date){
                    $form_date = strtotime(request()->form_date. ' 00:00:01');
                    $to_date = strtotime(request()->form_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }
                else if(request()->to_date){
                    $form_date = strtotime(request()->to_date. ' 00:00:01');
                    $to_date = strtotime(request()->to_date. ' 23:59:59');
                    $data = $data->whereBetween('date',[$form_date, $to_date]);
                }
                else{
                    $data = $data;
                }
            }

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('order_id', function ($row) {
                    return zero($row->id);
                })
                ->addColumn('status', function ($row) {
                    return ucwords(array_flip(Constant::ORDER_STATUS)[$row->order_status]);
                })
                ->addColumn('date', function ($row) {
                    $date = date('d M Y', strtotime($row->created_at)).' </br>' .date('h:i:s a', strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('approve_date', function ($row) {
                    if($row->updated_at != $row->created_at){
                        $update = date('d M Y', strtotime($row->updated_at)).' </br>' .date('h:i:s a', strtotime($row->updated_at));
                    }
                    else{
                        $update = 'N/A';
                    }
                    return $update;
                })
                ->rawColumns(['sl','order_id' ,'status', 'date', 'approve_date'])
                ->make(true);
        }
        return view('user.page.purchase.index', compact('pageTitle'));
    }

    public function PackageStockList(){
        $pageTitle = 'Package Stock';

        if (request()->ajax()) {
            $data = Package::all();
            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('product', function ($row) {
                    $img = "https://diamondvalley.com.bd/images/image-not-found.png";
                    if($row->image != null){
                        $img = asset("uploads/package/".$row->image);
                    }
                    $html = '<div class="d-flex">
                        <div style="width: 70px; border: 1px solid #ddd; padding: 2px; border-radius: 4px; vertical-align: middle; text-align: center; margin: auto 0px;">
                            <img style="width: 100%; height: 70px" src="'.$img.'" alt="">
                        </div>
                        <div style="margin-left: 10px; text-align: left;">
                            <a target="_bank" href="javascript::">
                                <h5 style="font-size: 15px;">'.$row->name.'</h5>
                                <p style="font-size: 13px;" class="my-0">Price :<span>'.$row->price.'</span></p>
                                <p style="font-size: 13px;" class="my-0">Point :<span>'.$row->point.'</span></p>
                            </a>
                        </div>
                    </div>';
                    return $html;
                })
                ->addColumn('purchase', function ($row) {
                    return $this->package_purchase_qty($row->id, Auth::user()->id);
                })
                ->addColumn('purchase_price', function ($row) {
                    $total_qty = $this->package_purchase_qty($row->id, Auth::user()->id);
                    $price =  $this->package_purchase_price($row->id, Auth::user()->id);

                    $total_price_amount =  $total_qty * $price;
                    return $total_price_amount ?? '0';
                })
                ->addColumn('sell', function ($row) {
                    return $this->package_sell_qty($row->id, Auth::user()->username);
                })
                ->addColumn('stock', function ($row) {
                    return $this->package_stock($row->id, Auth::user()->username, Auth::user()->id);
                })
                ->rawColumns(['sl','product','purchase','sell','stock'])
                ->make(true);
        }
        return view('user.page.stock.package.index', compact('pageTitle'));
    }
}
