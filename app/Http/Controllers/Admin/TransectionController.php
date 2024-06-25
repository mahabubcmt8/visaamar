<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransectionController extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = 'All Transections';

        if (request()->ajax()) {
            $data = Transaction::orderBy('id', 'DESC');

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('user', function ($row) {
                    $html = '<p class="my-0">Name : '.$row->user->name.' </p> <p class="my-0">Username : '.$row->user->username.'</p>';
                    return $html;
                })
                ->addColumn('wallet_type', function ($row) {
                    if($row->wallet_type != null){
                        $data = array_flip(Constant::WALLET_TYPE)[$row->wallet_type];
                        return ucwords(str_replace('_',' ',$data));
                    }else{
                        return '';
                    }
                })
                ->addColumn('transaction_type', function ($row) {
                    if($row->transaction_type != null){
                        $data = array_flip(Constant::TRANSACTION_TYPE)[$row->transaction_type];
                        return ucwords(str_replace('_',' ',$data));
                    }
                    else{
                        return '';
                    }
                })
                ->addColumn('status', function ($row) {
                    if($row->status != null){
                        $data = array_flip(Constant::STATUS)[$row->status];
                        return ucwords(str_replace('_',' ',$data));
                    }
                    else{
                        return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<button type="button" onclick="edit('.$row->id.')"  class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i></button>';
                    $btn2 = '<button onclick="destroy('.$row->id.')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>';
                    return $btn1.$btn2;
                })
                ->rawColumns(['action', 'user', 'id', 'wallet_type', 'transaction_type', 'status'])
                ->make(true);
        }

        return view('admin.page.transection.index', compact('pageTitle'));
    }

    public function destroy($id){
        $data = Transaction::findOrFail($id);
        if($data == true){
            $data->forceDelete();
        }
        return response()->json($data);
    }

    public function edit($id){
        $data = Transaction::with('user')->where('id', $id)->first();
        return response()->json($data);
    }
}
