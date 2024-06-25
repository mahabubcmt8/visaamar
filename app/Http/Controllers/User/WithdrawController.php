<?php

namespace App\Http\Controllers\User;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\AmountCheckRole;
use App\Http\Requests\Rules\WithdrawAmountCheckRole;
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
            $data = Transaction::orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->where('transaction_type', Constant::TRANSACTION_TYPE['withdraw']);


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
                ->rawColumns(['sl', 'amount', 'method', 'status', 'date', 'approve_date'])
                ->make(true);
        }
        if(Auth::user()->type == Constant::USER_TYPE['agent']){
            return view('user.page.withdraw.index', compact('pageTitle'));
        }
        else{
            return view('customer.page.withdraw.index', compact('pageTitle'));
        }

    }
    public function create(){
        $pageTitle = 'Create Withdraw';

        if(Auth::user()->type == Constant::USER_TYPE['agent']){
            return view('user.page.withdraw.create',compact('pageTitle'));
        }
        else{
            return view('customer.page.withdraw.create',compact('pageTitle'));
        }
    }

    public function store(Request $request) {
        $data = $request->validate([
            'method' => ["required","max:200","min:1"],
            'wallet_no' => ["required","max:11","min:11"],
            'amount' => ["required","max:20","min:1",'regex:/^\d+(\.\d+)?$/', new WithdrawAmountCheckRole],
        ]);

        $data = Transaction::create([
            'user_id' => auth()->user()->id,
            'wallet_type' => Constant::WALLET_TYPE['active_balance'],
            'deb_amount' => $request->amount,
            'cred_amount' => 0,
            'currency' => "BDT",
            'status' => Constant::STATUS['approved'],
            'in_status' => Constant::IN_STATUS['active'],
            'transaction_type' => Constant::TRANSACTION_TYPE['withdraw'],
            'transaction_note' => 'Balance Withdrawal - Date : '. date('d M Y h:i:s a'),
            'method' => $request->method,
            'wallet_address' => $request->wallet_no,
            'currency' => Constant::CURRENCY['name'],
            'withdrawal_status' => Constant::WITHDRAW_STATUS['pending'],
            'date' => time(),
        ]);

        return response()->json($data);
    }
}
