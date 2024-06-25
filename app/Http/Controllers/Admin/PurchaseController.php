<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Psy\Readline\Transient;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = '';
        if (request()->has('placed_orders')){
            $pageTitle = 'Placed Agent Product Orders';
        }
        else if (request()->has('logistic_orders')){
            $pageTitle = 'Process Agent Product Orders';
        }
        else if (request()->has('deliverd_orders')){
            $pageTitle = 'Deliverd Agent Product Orders';
        }
        else if (request()->has('rejected_orders')){
            $pageTitle = 'Rejected Agent Product Orders';
        }
        else{
            $pageTitle = 'Requested Agent Product Orders';
        }

        if (request()->ajax()) {
            $data = Invoice::where('type', Constant::ORDER_TYPE['agent']);;

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
                else{
                    $data = null;
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

                    $button2 = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['placed'].')" class="btn btn-sm btn-success ml-2" style="padding: 2px 6px;">Placed</button>';

                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['logistic'].')" type="button" class="btn btn-sm btn-secondary ml-2" style="padding: 2px 6px;">Logistic</button>';

                    $button4 = '<button onclick="status('.$row->id.', '.Constant::STATUS['approved'].', '.Constant::ORDER_STATUS['deliverd'].')" type="button" class="btn btn-sm btn-primary ml-2" style="padding: 2px 6px;">Deliverd</button>';

                    $button5 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].', '.Constant::ORDER_STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    if($row->order_status != Constant::ORDER_STATUS['rejected']){
                        return $button1.$button2.$button3.'<br><br>'.$button4.$button5;
                    }
                    else{
                        return 'N/A';
                    }

                })
                ->rawColumns(['sl' ,'user', 'order_id' ,'status', 'date', 'approve_date', 'action'])
                ->make(true);
        }
        return view('admin.page.order.agent.index', compact('pageTitle'));
    }

    public function status($id, $status, $order_status){
        $data = Invoice::findOrFail($id);
        $data->status = $status;
        $data->order_status = $order_status;

        if(($order_status == Constant::ORDER_STATUS['deliverd'])){
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
                'transaction_type' => Constant::TRANSACTION_TYPE['product_purchase'],
                'transaction_note' => 'Product purchase admin to '.$data->user_id,
                'currency' => Constant::CURRENCY['name'],
                'date' => time(),
            ]);
        }

        if(($order_status == Constant::ORDER_STATUS['pending']) || ($order_status == Constant::ORDER_STATUS['rejected'])){
            $transection = Transaction::where('invoice_id', $data->id)->where('user_id', $data->user_id)->first();
            if($transection == true){
                $transection->forceDelete();
            }
        }

        $data->save();
        return response()->json($data);
    }

    public function package_orders(){
        $pageTitle = '';
        if (request()->has('placed_orders')){
            $pageTitle = 'Placed Agent Package Orders';
        }
        else if (request()->has('logistic_orders')){
            $pageTitle = 'Process Agent Package Orders';
        }
        else if (request()->has('deliverd_orders')){
            $pageTitle = 'Deliverd Agent Package Orders';
        }
        else if (request()->has('rejected_orders')){
            $pageTitle = 'Rejected Agent Package Orders';
        }
        else{
            $pageTitle = 'Requested Agent Package Orders';
        }

        if (request()->ajax()) {
            $data = Invoice::where('type', Constant::ORDER_TYPE['agent_packege']);;

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
                else{
                    $data = null;
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

                    $button2 = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['placed'].')" class="btn btn-sm btn-success ml-2" style="padding: 2px 6px;">Placed</button>';

                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].', '.Constant::ORDER_STATUS['logistic'].')" type="button" class="btn btn-sm btn-secondary ml-2" style="padding: 2px 6px;">Logistic</button>';

                    $button4 = '<button onclick="status('.$row->id.', '.Constant::STATUS['approved'].', '.Constant::ORDER_STATUS['deliverd'].')" type="button" class="btn btn-sm btn-primary ml-2" style="padding: 2px 6px;">Deliverd</button>';

                    $button5 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].', '.Constant::ORDER_STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    if(($row->order_status != Constant::ORDER_STATUS['rejected']) && ($row->order_status != Constant::ORDER_STATUS['deliverd'])){
                        return $button1.$button2.$button3.'<br><br>'.$button4.$button5;
                    }
                    else{
                        return 'N/A';
                    }

                })
                ->rawColumns(['sl' ,'user', 'order_id' ,'status', 'date', 'approve_date', 'action'])
                ->make(true);
        }
        return view('admin.page.order.package.agent.index', compact('pageTitle'));
    }

    public function package_status($id, $status, $order_status){
        $data = Invoice::findOrFail($id);
        $data->status = $status;
        $data->order_status = $order_status;

        if(($order_status == Constant::ORDER_STATUS['deliverd'])){
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
                'transaction_type' => Constant::TRANSACTION_TYPE['package_purchase'],
                'transaction_note' => 'Package purchase admin to '.$data->user_id,
                'currency' => $data->user->countryInfo->currency_name,
                'date' => time(),
            ]);
        }

        if(($order_status != Constant::ORDER_STATUS['deliverd'])){
            $transection = Transaction::where('invoice_id', $data->id)->where('user_id', $data->user_id)->where('transaction_type', Constant::TRANSACTION_TYPE['package_purchase'])->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->first();
            if($transection == true){
                $transection->forceDelete();
            }
        }

        $data->save();
        return response()->json($data);
    }
}
