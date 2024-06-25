<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WithdrawController extends Controller
{
    use RowIndex;
    public function index(){
        if (request()->has('approved_list')){
            $pageTitle = 'Approved Withdraw List';
        }
        else if (request()->has('rejected_list')){
            $pageTitle = 'Rejected Withdraw List';
        }
        else{
            $pageTitle = 'Pending Withdraw List';
        }

        if (request()->ajax()) {
            $data = Transaction::orderBy('id', 'DESC')->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->where('transaction_type', Constant::TRANSACTION_TYPE['withdraw']);


            if(request()->has('approved_list')){
                $data = $data->where('status', Constant::STATUS['approved'])->where('withdrawal_status', Constant::WITHDRAW_STATUS['approved']);
            }
            elseif(request()->has('rejected_list')){
                $data = $data->where('status', Constant::STATUS['rejected'])->where('withdrawal_status', Constant::WITHDRAW_STATUS['rejected']);
            }
            else{
                $data = $data->where('status', Constant::STATUS['approved'])->whereIn('withdrawal_status', [Constant::WITHDRAW_STATUS['pending'], Constant::WITHDRAW_STATUS['processing'], Constant::WITHDRAW_STATUS['confirmed']]);
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
                ->addColumn('user', function ($row) {
                    return 'User: '.$row->user->name.'</br>Username: '.$row->user->username;
                })
                ->addColumn('amount', function ($row) {
                    return number_format($row->deb_amount, 2);
                })
                ->addColumn('method', function ($row) {
                    return ucwords(array_flip(Constant::METHOD)[$row->method]);
                })
                ->addColumn('status', function ($row) {
                    return ucwords(array_flip(Constant::WITHDRAW_STATUS)[$row->withdrawal_status]);
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
                    $button = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['approved'].','.Constant::WITHDRAW_STATUS['approved'].')" class="btn btn-sm btn-success" style="padding: 2px 6px;">Approve</button>';

                    $button2 = '<button onclick="status('.$row->id.', '.Constant::STATUS['approved'].','.Constant::WITHDRAW_STATUS['pending'].')" type="button" class="btn btn-sm btn-warning ml-2" style="padding: 2px 6px;">Pending</i></button>';

                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].','.Constant::WITHDRAW_STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    if($row->withdrawal_status == Constant::WITHDRAW_STATUS['approved']){
                        return $button2.$button3;
                    }
                    else if($row->withdrawal_status == Constant::WITHDRAW_STATUS['pending']){
                        return $button.$button3;
                    }
                    else if($row->withdrawal_status == Constant::WITHDRAW_STATUS['rejected']){
                        return $button.$button2;
                    }
                    else{
                        return 'N/A';
                    }

                })
                ->rawColumns(['sl','user' ,'amount', 'method', 'status', 'date', 'approve_date', 'action'])
                ->make(true);
        }
        return view('admin.page.withdraw.index', compact('pageTitle'));
    }

    public function status($id, $status, $withdraw_status){
        $data = Transaction::findOrFail($id);
        $data->status = $status;
        $data->withdrawal_status = $withdraw_status;
        $data->save();
        return $data;
    }

}
