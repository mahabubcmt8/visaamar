<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CustomerReports extends Controller
{
    use RowIndex;
    public function index(){
        $pageTitle = 'My All Commission';
        if (request()->ajax()) {
            $data = Transaction::where('user_id', Auth::user()->id)->whereIn('transaction_type', [Constant::TRANSACTION_TYPE['sell_commission'], Constant::TRANSACTION_TYPE['generation_income']]);

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


            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('date', function ($row) {
                    $date = date('d M Y', strtotime($row->created_at)).' </br>' .date('h:i:s a', strtotime($row->created_at));
                    return $date;
                })

                ->rawColumns(['sl', 'date'])
                ->make(true);
        }
        return view('customer.page.reports.index', compact('pageTitle'));
    }
}
