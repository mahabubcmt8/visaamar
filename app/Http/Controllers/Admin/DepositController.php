<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DepositController extends Controller
{
    use RowIndex;
    public function index(){

        if (request()->has('approved_list')){
            $pageTitle = 'Approved Deposit List';
        }
        else if (request()->has('rejected_list')){
            $pageTitle = 'Rejected Deposit List';
        }
        else{
            $pageTitle = 'Pending Deposit List';
        }

        if (request()->ajax()) {
            $data = Transaction::orderBy('id', 'DESC')->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->where('transaction_type', Constant::TRANSACTION_TYPE['add_fund']);

            if(request()->has('approved_list')){
                $data = $data->where('status', Constant::STATUS['approved']);
            }
            elseif(request()->has('rejected_list')){
                $data = $data->where('status', Constant::STATUS['rejected']);
            }
            else{
                $data = $data->where('status', Constant::STATUS['pending']);
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
                    return number_format($row->cred_amount, 2);
                })
                ->addColumn('method', function ($row) {
                    return ucwords(array_flip(Constant::METHOD)[$row->method]);
                })
                ->addColumn('status', function ($row) {
                    return ucwords(array_flip(Constant::STATUS)[$row->status]);
                })
                ->addColumn('date', function ($row) {
                    $date = date('d M Y', strtotime($row->created_at)).' </br>' .date('h:i:s a', strtotime($row->created_at));
                    return $date;
                })
                ->addColumn('approve_date', function ($row) {
                    if($row->updated_at != null){
                        $update = date('d M Y', strtotime($row->updated_at)).' </br>' .date('h:i:s a', strtotime($row->updated_at));
                    }
                    else{
                        $update = 'N/A';
                    }
                    return $update;
                })
                ->addColumn('image', function ($row) {
                    $image = ($row->image) ? asset('uploads/user/deposit'. $row->image) : asset('uploads/system'. companyInfo()->meta_image);

                    $html =  <<<HTML
                        <div class="text-center" uk-lightbox>
                            <a href="$image">
                                <img style="width: 45px; height: 45px; border: 1px solid #ddd; border-radius: 4px;" class="img-fluid" src="$image" alt="">
                            </a>
                        </div>
                    HTML;
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" onclick="status('.$row->id.', '.Constant::STATUS['approved'].')" class="btn btn-sm btn-success" style="padding: 2px 6px;">Approve</button>';
                    $button2 = '<button onclick="status('.$row->id.', '.Constant::STATUS['pending'].')" type="button" class="btn btn-sm btn-warning ml-2" style="padding: 2px 6px;">Pending</i></button>';
                    $button3 = '<button onclick="status('.$row->id.', '.Constant::STATUS['rejected'].')" type="button" class="btn btn-sm btn-danger ml-2" style="padding: 2px 6px;">Reject</button>';

                    if($row->status == Constant::STATUS['approved']){
                        return $button2.$button3;
                    }
                    else if($row->status == Constant::STATUS['pending']){
                        return $button.$button3;
                    }
                    else if($row->status == Constant::STATUS['rejected']){
                        return $button.$button2;
                    }
                    else{
                        return 'N/A';
                    }

                })
                ->rawColumns(['user','sl', 'amount', 'method', 'status', 'date', 'approve_date', 'action', 'image'])
                ->make(true);
        }
        return view('admin.deposit.index', compact('pageTitle'));
    }

    public function status($id, $status){
        $data = Transaction::findOrFail($id);
        $data->status = $status;
        $data->save();
        return $data;
    }
}
