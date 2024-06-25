<?php

namespace App\Helpers\Traits;

use App\Helpers\Constant;
use App\Models\Generation;
use App\Models\Transaction;
use App\Models\User;

trait DistributeGenBonusTrait{

    public function referUserLavelCount($data, $username, $username2){
        $level = $data[$username]->referrals;
        $level_all = [];
        $level_all['level0'] = [];
        $level_all['level1'] = [];
        $lavel_count = 0;
        foreach($level as $lv1){
            $level_all['level0'] = array_merge($level_all['level0'], [ ['username' => $lv1->username] ]);
            $find = $this->FindUserCount2($data, $lv1->username);
            $level_all['level1'] = array_merge($level_all['level1'], $find['user']);
        }
        for($i = (count($level_all) - 2); count($level_all['level'.$i]) > 0; $i++){
            $level_all['level'.$x=($i+1)] = [];
            foreach($level_all['level'.$i] as $d){
                $find = $this->FindUserCount2($data, $d['username']);
                $level_all['level'.$x= ($i + 1)] = array_merge($level_all['level'.$x= ($i + 1)], $find['user']);
            }
            if(!count($level_all)){
                break;
            }
            // break;
        }

        foreach ($level_all as $level => $users) {
            // Iterate over each user in the current level
            foreach ($users as $user) {
                $lavel_count++;
                if($user["username"] == $username2){
                    return $lavel_count;
                    break;
                }
            }
        }

        return 0;
    }

    public function FindUserCount2($data, $username){
        $arr = [];
        $user = $data[$username]->referrals;
        foreach($user as $usr){
            $arr[] = ['username' => $usr->username];
        }
        return ['user' => $arr];
    }

    public function distribute($invoice_id, $users ,$user_id, $amount) {
        $user_details = User::where('id', $user_id)->first();
        $all_gen = Generation::all();
        $gen_sl = 0;
        $gen_user = $user_id;
        $gen_arr = [];
        foreach($all_gen as $gen){
            $gen_sl = $gen_sl + 1;
            $gen_name = $gen->name;
            $get_gen_user = User::with('refferrer', 'rank')->where('id', $gen_user)->first();
            if($gen_user == null){
                break;
            }
            if($get_gen_user == false){
                break;
            }

            $gen_user = isset($get_gen_user->refferrer->id) ? $get_gen_user->refferrer->id : null;

            $get_gen_user2 = User::with('rank')->where('username', $get_gen_user->refferrer->username ?? null)->first();
            if($get_gen_user2 == false){
                break;
            }
            $gen_user_rank = isset($get_gen_user2->rank) ? $get_gen_user2->rank->rank_name : null;

            array_push($gen_arr, ['serial' => $gen_sl, 'gen' => $gen_user, 'gen_username' => $get_gen_user->refferrer->username, 'rank' => $gen_user_rank, 'percentage' => $gen->comission]);
        }
        $i = 0;
        $rr = '';
        foreach($gen_arr as $bons){
            if($bons['gen'] != null){

                if(($bons['serial'] === 7) && (($bons['rank'] === 'diamond_director') || ($bons['rank'] === 'star_ambassador') || ($bons['rank'] === 'brand_ambassador'))){
                    $transaction = Transaction::create([
                        'user_id' => $bons['gen'],
                        'invoice_id' => $invoice_id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => 0,
                        'cred_point' => ($amount * $bons['percentage']) / 100,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_note'=>'Leadership Commission Generation '.($bons['serial']) .' from '.$user_details->username,
                        'transaction_type'=>Constant::TRANSACTION_TYPE['generation_income'],
                        'status' => Constant::STATUS['approved'],
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time()
                    ]);
                }

                if(($bons['serial'] === 6) && (($bons['rank'] === 'ruby_director') || ($bons['rank'] === 'diamond_director') || ($bons['rank'] === 'star_ambassador') || ($bons['rank'] === 'brand_ambassador'))){
                    $transaction = Transaction::create([
                        'user_id' => $bons['gen'],
                        'invoice_id' => $invoice_id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => 0,
                        'cred_point' => ($amount * $bons['percentage']) / 100,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_note'=>'Leadership Commission Generation '.($bons['serial']) .' from '.$user_details->username,
                        'transaction_type'=>Constant::TRANSACTION_TYPE['generation_income'],
                        'status' => Constant::STATUS['approved'],
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time()
                    ]);
                }

                if(($bons['serial'] === 5) && (($bons['rank'] === 'crown_director') || ($bons['rank'] === 'ruby_director') || ($bons['rank'] === 'diamond_director') || ($bons['rank'] === 'star_ambassador') || ($bons['rank'] === 'brand_ambassador'))){
                    $transaction = Transaction::create([
                        'user_id' => $bons['gen'],
                        'invoice_id' => $invoice_id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => 0,
                        'cred_point' => ($amount * $bons['percentage']) / 100,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_note'=>'Leadership Commission Generation '.($bons['serial']) .' from '.$user_details->username,
                        'transaction_type'=>Constant::TRANSACTION_TYPE['generation_income'],
                        'status' => Constant::STATUS['approved'],
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time()
                    ]);
                }

                if(($bons['serial'] === 4) && (($bons['rank'] === 'platinum_director') || ($bons['rank'] === 'crown_director') || ($bons['rank'] === 'ruby_director') || ($bons['rank'] === 'diamond_director') || ($bons['rank'] === 'star_ambassador') || ($bons['rank'] === 'brand_ambassador'))){
                    $transaction = Transaction::create([
                        'user_id' => $bons['gen'],
                        'invoice_id' => $invoice_id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => 0,
                        'cred_point' => ($amount * $bons['percentage']) / 100,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_note'=>'Leadership Commission Generation '.($bons['serial']) .' from '.$user_details->username,
                        'transaction_type'=>Constant::TRANSACTION_TYPE['generation_income'],
                        'status' => Constant::STATUS['approved'],
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time()
                    ]);
                }

                if(($bons['serial'] === 3) && (($bons['rank'] === 'gold_director') || ($bons['rank'] === 'platinum_director') || ($bons['rank'] === 'crown_director') || ($bons['rank'] === 'ruby_director') || ($bons['rank'] === 'diamond_director') || ($bons['rank'] === 'star_ambassador') || ($bons['rank'] === 'brand_ambassador'))){
                    $transaction = Transaction::create([
                        'user_id' => $bons['gen'],
                        'invoice_id' => $invoice_id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => 0,
                        'cred_point' => ($amount * $bons['percentage']) / 100,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_note'=>'Leadership Commission Generation '.($bons['serial']) .' from '.$user_details->username,
                        'transaction_type'=>Constant::TRANSACTION_TYPE['generation_income'],
                        'status' => Constant::STATUS['approved'],
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time()
                    ]);
                }

                if(($bons['serial'] === 2) && (($bons['rank'] === 'silver_director') || ($bons['rank'] === 'gold_director') || ($bons['rank'] === 'platinum_director') || ($bons['rank'] === 'crown_director') || ($bons['rank'] === 'ruby_director') || ($bons['rank'] === 'diamond_director') || ($bons['rank'] === 'star_ambassador') || ($bons['rank'] === 'brand_ambassador'))){
                    $transaction = Transaction::create([
                        'user_id' => $bons['gen'],
                        'invoice_id' => $invoice_id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => 0,
                        'cred_point' => ($amount * $bons['percentage']) / 100,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_note'=>'Leadership Commission Generation '.($bons['serial']) .' from '.$user_details->username,
                        'transaction_type'=>Constant::TRANSACTION_TYPE['generation_income'],
                        'status' => Constant::STATUS['approved'],
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time()
                    ]);
                }

                if(($bons['serial'] === 1) && (($bons['rank'] === 'sales_manager') || ($bons['rank'] === 'silver_director') || ($bons['rank'] === 'gold_director') || ($bons['rank'] === 'platinum_director') || ($bons['rank'] === 'crown_director') || ($bons['rank'] === 'ruby_director') || ($bons['rank'] === 'diamond_director') || ($bons['rank'] === 'star_ambassador') || ($bons['rank'] === 'brand_ambassador'))){
                    $transaction = Transaction::create([
                        'user_id' => $bons['gen'],
                        'invoice_id' => $invoice_id,
                        'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                        'deb_amount' => 0,
                        'cred_amount' => 0,
                        'cred_point' => ($amount * $bons['percentage']) / 100,
                        'deb_point' => 0,
                        'status' => Constant::STATUS['approved'],
                        'in_status' => Constant::IN_STATUS['active'],
                        'transaction_note' => 'Leadership Commission Generation '.($bons['serial']) .' from '.$user_details->username,
                        'transaction_type' => Constant::TRANSACTION_TYPE['generation_income'],
                        'status' => Constant::STATUS['approved'],
                        'currency' => Constant::CURRENCY['name'],
                        'date' => time()
                    ]);
                }

            }
        }

        // return $this->referUserLavelCount($users, 'user9' ,$user_details->username);
        return $gen_arr;
    }

}
