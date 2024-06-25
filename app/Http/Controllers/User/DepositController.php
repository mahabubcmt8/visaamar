<?php

namespace App\Http\Controllers\User;

use App\Helpers\Constant;
use App\Helpers\Traits\RowIndex;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\AmountCheckRole;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class DepositController extends Controller
{
    use RowIndex;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            $data = Transaction::orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->where('transaction_type', Constant::TRANSACTION_TYPE['add_fund']);


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
                ->addColumn('amount', function ($row) {
                    return number_format($row->cred_amount, 2);
                })
                ->addColumn('method', function ($row) {
                    return ucwords(array_flip(Constant::METHOD)[$row->method]);
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
                ->addColumn('status', function ($row) {
                    return ucwords(array_flip(Constant::STATUS)[$row->status]);
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
                ->rawColumns(['sl', 'amount', 'method', 'status', 'date', 'approve_date', 'image'])
                ->make(true);
        }
        return view('user.deposit.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Deposit';
        return view('user.deposit.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'method' => ["required","max:200","min:1"],
            'wallet_no' => ["required","max:11","min:11"],
            'transaction_no' => ["required","max:15","min:6"],
            'amount' => ["required","max:20","min:1",'regex:/^\d+(\.\d+)?$/', new AmountCheckRole],
            'image' => ["nullable","max:2048","mimes:jpg,png,gif,jpeg"],
        ]);

        if ($request->hasFIle('image')){
            $img = $request->file('image');
            $img_name = auth()->user()->id.'-'. time().'.'.$img->getclientoriginalextension();
            Image::make($img)->save(public_path('uploads/user/deposit'.$img_name));
        }

        $data = Transaction::create([
            'user_id' => auth()->user()->id,
            'wallet_type' => Constant::WALLET_TYPE['active_balance'],
            'deb_amount' => 0,
            'cred_amount' => $request->amount,
            'status' => Constant::STATUS['pending'],
            'in_status' => Constant::IN_STATUS['active'],
            'transaction_type' => Constant::TRANSACTION_TYPE['add_fund'],
            'transaction_no' => $request->transaction_no,
            'transaction_note' => 'Fund Added - Date : '. date('d M Y h:i:s a'),
            'method' => $request->method,
            'wallet_address' => $request->wallet_no,
            'currency' => auth()->user()->countryInfo->currency_name,
            'image' => (isset($img_name) ? $img_name : null),
            'date' => time(),
        ]);

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
