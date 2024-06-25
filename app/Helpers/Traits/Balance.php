<?php

namespace App\Helpers\Traits;

use App\Helpers\Constant;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait Balance
{
    public static function available_balance(){
        $user_id = Auth::user()->id;
        $total = Transaction::where('user_id', $user_id)->where('status', Constant::STATUS['approved'])->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->whereIn('transaction_type', [Constant::TRANSACTION_TYPE['sell_commission'], Constant::TRANSACTION_TYPE['withdraw'], Constant::TRANSACTION_TYPE['add_fund'], Constant::TRANSACTION_TYPE['product_purchase'], Constant::TRANSACTION_TYPE['package_purchase']])->select(DB::raw('ifnull(sum(cred_amount - deb_amount),0) as total'))->get();
        return $total[0]->total;
    }

    public static function deposit_balance(){
        $user_id = Auth::user()->id;
        $total = Transaction::where('user_id', $user_id)->where('status', Constant::STATUS['approved'])->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->where('transaction_type', Constant::TRANSACTION_TYPE['add_fund'])->select(DB::raw('ifnull(sum(cred_amount),0) as total'))->get();
        return $total[0]->total;
    }

    public static function available_point(){
        $user_id = Auth::user()->id;

        $total = Transaction::where('user_id', $user_id)->where('status', Constant::STATUS['approved'])->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->whereIn('transaction_type', [Constant::TRANSACTION_TYPE['sell_commission'], Constant::TRANSACTION_TYPE['generation_income']])->select(DB::raw('ifnull(sum(cred_point - deb_point),0) as total'))->get();
        return $total[0]->total;
    }

    public static function total_purchase_amount(){
        $user_id = Auth::user()->id;
        $total = Transaction::where('user_id', $user_id)->where('status', Constant::STATUS['approved'])->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->whereIn('transaction_type', [Constant::TRANSACTION_TYPE['product_purchase'], Constant::TRANSACTION_TYPE['package_purchase']])->select(DB::raw('ifnull(sum(deb_amount),0) as total'))->get();
        return $total[0]->total;
    }

    public static function withdraw_amount($transaction_type){
        $user_id = Auth::user()->id;
        $total = Transaction::where('user_id', $user_id)->where('status', Constant::STATUS['approved'])->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->where('transaction_type', Constant::TRANSACTION_TYPE['withdraw'])->where('withdrawal_status', Constant::WITHDRAW_STATUS[$transaction_type])->select(DB::raw('ifnull(sum(deb_amount),0) as total'))->get();
        return $total[0]->total;
    }

    public static function company_total_sell_point(){
        $total = Transaction::where('status', Constant::STATUS['approved'])->where('in_status', Constant::IN_STATUS['active'])->where('wallet_type', Constant::WALLET_TYPE['active_balance'])->where('transaction_type', Constant::TRANSACTION_TYPE['product_sell'])->select(DB::raw('ifnull(sum(cred_point),0) as total'))->get();
        return $total[0]->total;
    }
}
