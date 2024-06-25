<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\CookieCheckRule;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = 'My Orders';
        if (request()->ajax()) {
            $data = Invoice::where('user_id', Auth::user()->id)->whereIn('type', [Constant::ORDER_TYPE['customer'], Constant::ORDER_TYPE['customer_packege']]);

            if (request()->has('deliverd')){
                $data = $data->where('status', Constant::STATUS['approved'])->where('order_status', Constant::ORDER_STATUS['deliverd']);
            }
            else{
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', '!=' , Constant::ORDER_STATUS['deliverd']);
            }

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
        return view('customer.page.order.index', compact('pageTitle'));
    }

    public function store(Request $request){

        $data = Validator::make($request->all(),[
            'cookie_id' => ["required", new CookieCheckRule],
        ]);

        if($data->passes()){
            $cookie_id = request()->cookie('cookie_id');
            $cartInfo = DB::table('carts')
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->where('carts.cookie_id', '=', $cookie_id)
                ->select(
                    DB::raw('SUM(CASE WHEN products.offer_price IS NOT NULL AND products.offer_price != 0 THEN carts.quantity * products.offer_price ELSE carts.quantity * products.price END) as total_amount'),
                    DB::raw('SUM(carts.quantity * products.point) as total_point')
                )
                ->first();

            $invoice = new Invoice;
            $invoice->user_id = Auth::user()->id;
            $invoice->agent_id = Auth::user()->agent;
            $invoice->refer_id = Auth::user()->refer;
            $invoice->total_point = $cartInfo->total_point;
            $invoice->sub_total = $cartInfo->total_amount;
            $invoice->bill_amount = $cartInfo->total_amount;
            $invoice->type = Constant::ORDER_TYPE['customer'];
            $invoice->status = Constant::STATUS['pending'];
            $invoice->order_status = Constant::ORDER_STATUS['pending'];
            $invoice->cookie_id = $cookie_id;
            $invoice->date = time();
            $invoice->save();

            $cartItems = Cart::where('cookie_id', $cookie_id)->get();
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

            Cookie::queue(Cookie::forget('cookie_id'));
            return redirect()->route('user.customer.home')->with('success', 'Order Submited Successfully!');
        }

        return redirect()->back()->with('error', 'Add To Cart Faild! Please Try Again');
    }
}
