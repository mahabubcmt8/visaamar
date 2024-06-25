<?php

namespace App\Http\Controllers\User;

use App\Helpers\Constant;
use App\Helpers\Traits\DistributeGenBonusTrait;
use App\Helpers\Traits\GiveRankCommissionTrait;
use App\Helpers\Traits\RankCalculationTrait;
use App\Helpers\Traits\RowIndex;
use App\Helpers\Traits\StockTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\CookieCheckRule;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Package;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    use RowIndex, GiveRankCommissionTrait, RankCalculationTrait, StockTrait, DistributeGenBonusTrait;
    public function index(){
        $pageTitle = '';
        if (request()->has('placed_orders')){
            $pageTitle = 'Placed Product Orders';
        }
        else if (request()->has('logistic_orders')){
            $pageTitle = 'Process Product Orders';
        }
        else if (request()->has('deliverd_orders')){
            $pageTitle = 'Deliverd Product Orders';
        }
        else if (request()->has('rejected_orders')){
            $pageTitle = 'Rejected Product Orders';
        }
        else{
            $pageTitle = 'Requested Product Orders';
        }

        if (request()->ajax()) {
            $data = Invoice::where('agent_id', Auth::user()->username)->where('type', Constant::ORDER_TYPE['customer']);

            if (request()->has('placed_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['placed']);
            }
            else if (request()->has('logistic_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['logistic']);
            }
            else if (request()->has('deliverd_orders')){
                $data = $data->where('status', Constant::STATUS['approved'])->where('order_status', Constant::ORDER_STATUS['deliverd']);
            }
            else if (request()->has('rejected_orders')){
                $data = $data->where('status', Constant::STATUS['rejected'])->where('order_status', Constant::ORDER_STATUS['rejected']);
            }
            else{
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['pending']);
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

            }

             if(request()->user_name != ''){
                $userInfo = User::where('username', request()->user_name)->first();
                if($userInfo == true){
                    $data = $data->where('user_id', $userInfo->id);
                }
            }

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('user', function ($row) {
                    return 'Name : '. $row->user->name.'<br> Username : '. $row->user->username.'<br> Phone : '. $row->user->phone;
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
                ->addColumn('action', function ($row) {
                    $button1 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['pending'].')" type="button" class="btn btn-sm btn-warning ml-2" style="padding: 2px 6px;">Pending</i></button>';

                    $button2 = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['placed'].')" class="btn btn-sm btn-success" style="padding: 2px 6px;">Placed</button>';

                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['logistic'].')" type="button" class="btn btn-sm btn-secondary ml-2" style="padding: 2px 6px;">Logistic</button>';

                    $button4 = '<button onclick="status('.$row->id.', '.Constant::STATUS['approved'].', '.Constant::ORDER_STATUS['deliverd'].')" type="button" class="btn btn-sm btn-primary ml-2" style="padding: 2px 6px;">Deliverd</button>';

                    $button5 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].', '.Constant::ORDER_STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    if($row->order_status == Constant::ORDER_STATUS['pending']){
                        return $button2.$button5;
                    }
                    else if($row->order_status == Constant::ORDER_STATUS['placed']){
                        return $button3.$button1.$button5;
                    }
                    else if($row->order_status == Constant::ORDER_STATUS['logistic']){
                        return $button4.$button5;
                    }
                    else{
                        return 'N/A';
                    }
                })
                ->rawColumns(['sl', 'user', 'order_id' ,'status', 'date', 'approve_date', 'action'])
                ->make(true);
        }
        return view('user.page.order.index', compact('pageTitle'));
    }

    public function status($id, $status, $order_status){
        $data = Invoice::findOrFail($id);
        $data->status = $status;
        $data->order_status = $order_status;

        $user = User::find($data->user_id);
        $stock = 'stock_in';
        if($order_status == Constant::ORDER_STATUS['deliverd']){
            // Check invoice item product stock
            $items = InvoiceItem::where('invoice_id', $id)->get();
            foreach($items as $item){
                if($this->stock($item->product_id, Auth::user()->username, Auth::user()->id) < $item->qty){
                    $stock = 'stock_out';
                }
            }
            if($stock === 'stock_out'){
                return $stock;
            }
            else{
                $transection = Transaction::where('invoice_id', $data->id)->where('user_id', $data->user_id)->first();
                if($transection == false){
                    // User Data Insart
                    Transaction::create([
                        'user_id' => $data->user_id,
                        'invoice_id' => $data->id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => $data->bill_amount,
                        'cred_amount' => 0,
                        'cred_point' => $data->total_point,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_type' => Constant::TRANSACTION_TYPE['product_sell'],
                        'transaction_note' => 'Product Purchase '.$data->agent_id.' to '.$user->username,
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time(),
                    ]);
                    // $result = $data->user_id.'-'.$data->total_point;

                    $users = $this->setKey(User::with('rank')->get());
                    $result = $this->distribute($data->id, $users, $data->user_id, $data->total_point);
                }
            }
        }

        if(($order_status != Constant::ORDER_STATUS['deliverd'])){
            // User Data Remove
            $transections = Transaction::where('invoice_id', $data->id)->get();
            foreach($transections as $transection){
                $transection->forceDelete();
            }
        }

        if($stock === 'stock_out'){
            return $stock;
        }
        else{
            $data->save();
            return $data;
        }
    }

    public function packageIndex(){
        $pageTitle = '';
        if (request()->has('placed_orders')){
            $pageTitle = 'Placed Package Orders';
        }
        else if (request()->has('logistic_orders')){
            $pageTitle = 'Process Package Orders';
        }
        else if (request()->has('deliverd_orders')){
            $pageTitle = 'Deliverd Package Orders';
        }
        else if (request()->has('rejected_orders')){
            $pageTitle = 'Rejected Package Orders';
        }
        else{
            $pageTitle = 'Requested Package Orders';
        }

        if (request()->ajax()) {
            $data = Invoice::where('agent_id', Auth::user()->username)->where('type', Constant::ORDER_TYPE['customer_packege']);

            if (request()->has('placed_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['placed']);
            }
            else if (request()->has('logistic_orders')){
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['logistic']);
            }
            else if (request()->has('deliverd_orders')){
                $data = $data->where('status', Constant::STATUS['approved'])->where('order_status', Constant::ORDER_STATUS['deliverd']);
            }
            else if (request()->has('rejected_orders')){
                $data = $data->where('status', Constant::STATUS['rejected'])->where('order_status', Constant::ORDER_STATUS['rejected']);
            }
            else{
                $data = $data->where('status', Constant::STATUS['pending'])->where('order_status', Constant::ORDER_STATUS['pending']);
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

            }

             if(request()->user_name != ''){
                $userInfo = User::where('username', request()->user_name)->first();
                if($userInfo == true){
                    $data = $data->where('user_id', $userInfo->id);
                }
            }

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('user', function ($row) {
                    return 'Name : '. $row->user->name.'<br> Username : '. $row->user->username.'<br> Phone : '. $row->user->phone;
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
                ->addColumn('action', function ($row) {
                    $button1 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['pending'].')" type="button" class="btn btn-sm btn-warning ml-2" style="padding: 2px 6px;">Pending</i></button>';

                    $button2 = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['placed'].')" class="btn btn-sm btn-success" style="padding: 2px 6px;">Placed</button>';

                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['logistic'].')" type="button" class="btn btn-sm btn-secondary ml-2" style="padding: 2px 6px;">Logistic</button>';

                    $button4 = '<button onclick="status('.$row->id.', '.Constant::STATUS['approved'].', '.Constant::ORDER_STATUS['deliverd'].')" type="button" class="btn btn-sm btn-primary ml-2" style="padding: 2px 6px;">Deliverd</button>';

                    $button5 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].', '.Constant::ORDER_STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    if($row->order_status == Constant::ORDER_STATUS['pending']){
                        return $button2.$button5;
                    }
                    else if($row->order_status == Constant::ORDER_STATUS['placed']){
                        return $button3.$button5;
                    }
                    else if($row->order_status == Constant::ORDER_STATUS['logistic']){
                        return $button2.$button4.$button5;
                    }
                    else{
                        return 'N/A';
                    }
                })
                ->rawColumns(['sl', 'user', 'order_id' ,'status', 'date', 'approve_date', 'action'])
                ->make(true);
        }
        return view('user.page.order.package.index', compact('pageTitle'));
    }
    public function packageStatus($id, $status, $order_status){
        $data = Invoice::findOrFail($id);
        $data->status = $status;
        $data->order_status = $order_status;

        $user = User::find($data->user_id);
        if($order_status == Constant::ORDER_STATUS['deliverd']){
            $transection = Transaction::where('invoice_id', $data->id)->where('user_id', $data->user_id)->first();
            if($transection == false){
                // User Transection Data Insart
                Transaction::create([
                    'user_id' => $data->user_id,
                    'invoice_id' => $data->id,
                    'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                    'deb_amount' => $data->bill_amount,
                    'cred_amount' => 0,
                    'cred_point' => $data->total_point,
                    'deb_point' => 0,
                    'status' => Constant::STATUS['approved'],
                    'in_status' => Constant::IN_STATUS['active'],
                    'transaction_type' => Constant::TRANSACTION_TYPE['package_sell'],
                    'transaction_note' => 'Package Purchase '.$data->agent_id.' to '.$user->username,
                    'currency' => Constant::CURRENCY['name'],
                    'date' => time(),
                ]);

                $users = $this->setKey(User::with('rank')->get());
                $this->distribute($data->id, $users, $data->user_id, $data->total_point);
            }
        }

        if(($order_status != Constant::ORDER_STATUS['deliverd'])){
            // User Data Remove
            $transections = Transaction::where('invoice_id', $data->id)->get();
            foreach($transections as $transection){
                $transection->forceDelete();
            }
        }

        $data->save();
        return $data;
    }

    public function create(){
        $pageTitle = 'Create New Orders';

        $Products = Product::all()->toArray();
        $Packages = Package::all()->toArray();

        // Add 'key_id' and 'item_id' to each item in the $products array
        foreach ($Products as &$product) {
            $product['key_id'] = $product['id'];
            $product['item_id'] = $product['id'];
            $product['item_type'] = 'product';
            unset($product['id']); // Optionally, you can remove the original 'id' key
        }

        // Add 'key_id' and 'item_id' to each item in the $packages array
        foreach ($Packages as &$package) {
            $package['key_id'] = $package['id'];
            $package['item_id'] = $package['id'];
            $package['item_type'] = 'package';
            unset($package['id']); // Optionally, you can remove the original 'id' key
        }

        // Merge the arrays based on the 'key_id'
        $mergedArray = array_merge($Products, $Packages);

        // Extract only 'key_id' and 'item_id'
        $products = array_map(function ($item) {
            return ['key_id' => $item['key_id'], 'item_id' => $item['item_id'], 'item_type' => $item['item_type']];
        }, $mergedArray);

        // Now $filteredArray contains only 'key_id' and 'item_id'
        // return $filteredArray;




        return view('user.page.order.create', compact('pageTitle', 'products'));
    }

}
