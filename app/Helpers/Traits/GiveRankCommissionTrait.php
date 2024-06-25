<?php

namespace App\Helpers\Traits;

use App\Helpers\Constant;
use App\Models\Transaction;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait GiveRankCommissionTrait{
    private function getUplines($data, $users) {
        $uplines = [];
        $user = $users[$data['username']] ?? null;
        for ($i = 1; $i <= 12; $i++) {
            $user = $users[$user['refer']] ?? null;
            // Break the loop if there is no more referral data or user is null
            if ($user === null || !isset($user['refer'])) {
                break;
            }

            $uplines["upline$i"] = $user;

            $uplines["upline$i"] = array_merge(['user_id' => $user['id'], 'username' => $user['username'], 'refer' => $user['refer'], 'user_rank' => ($user['rank']) ? $user['rank']['rank_name'] : 'unknown', 'self_bonus' => ($user['rank']) ? $user['rank']['self_bonus'] : '0', 'team_bonus' => ($user['rank']) ? $user['rank']['team_bonus'] : '0']);
        }
        return $uplines;
    }

    private function rankCommissionCalculate($data){
        // Check User Rank
        $commission = 0;
        $team_commission = 0;
        switch (true) {
            case $data['user_rank'] === 'customer' and $data['total_point'] != 0 and $data['self_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
            break;
            case $data['user_rank'] === 'distributor' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'leader' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'sales_manager' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'silver_director' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'gold_director' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'platinum_director' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'crown_director' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'ruby_director' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'diamond_director' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'star_ambassador' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;
            case $data['user_rank'] === 'brand_ambassador' and $data['total_point'] != 0 and $data['self_bonus'] != 0 and $data['team_bonus'] != 0:
                $commission = (($data['total_point'] * $data['self_bonus']) / 100);
                $team_commission = (($data['total_point'] * $data['team_bonus']) / 100);
            break;

            default:
                # code...
            break;
        }

        $arr = [
            'self_commission' => $commission,
            'team_commission' => $team_commission
        ];
        return $arr;
    }

    private function rankIndex($rank){
        $rank_name_data = [
            'customer',
            'distributor',
            'leader',
            'sales_manager',
            'silver_director',
            'gold_director',
            'platinum_director',
            'crown_director',
            'ruby_director',
            'diamond_director',
            'star_ambassador',
            'brand_ambassador',
        ];

        $key = array_search($rank, $rank_name_data);
        if ($key !== false) {
            return $key;
        }
        else{
            return false;
        }
    }

    public function rankCommission($data, $users){
        $self_data = $data;
        // User Rank Commission Insart
        $transaction = Transaction::create([
            'user_id' => $self_data['user_id'],
            'invoice_id' => $self_data['invoice_id'],
            'wallet_type' => Constant::WALLET_TYPE['active_balance'],
            'deb_amount' => 0,
            'cred_amount' => 0,
            'cred_point' => $this->rankCommissionCalculate($self_data)['self_commission'] ?? 0,
            'deb_point' => 0,
            'status' => Constant::STATUS['approved'],
            'in_status' => Constant::IN_STATUS['active'],
            'transaction_type' => Constant::TRANSACTION_TYPE['sell_commission'],
            'transaction_note' => 'Sell Commission for Invoice '.$self_data['invoice_id'].' To '.$self_data['username'],
            'currency' => Constant::CURRENCY['name'],
            'date' => time(),
        ]);

        $uplines = $this->getUplines($data, $users);
        foreach ($uplines as $upline) {
            if(($upline['user_rank'] !== 'customer') && ($upline['user_rank'] !== $self_data['user_rank']) && ($this->rankIndex($upline['user_rank']) > $this->rankIndex($self_data['user_rank']))){

                $rankDataArray = [
                    'user_id' => $upline['user_id'],
                    'invoice_id' => $self_data['invoice_id'],
                    'bill_amount' => $self_data['bill_amount'],
                    'total_point' => $self_data['total_point'],
                    'agent' => $self_data['agent'],
                    'username' => $upline['username'],
                    'user_rank' => ($upline['user_rank']) ? $upline['user_rank'] : 'unknown',
                    'self_bonus' => ($upline['self_bonus']) ? $upline['self_bonus'] : '0',
                    'team_bonus' => ($upline['team_bonus']) ? $upline['team_bonus'] : '0',
                ];

                $transaction = Transaction::create([
                    'user_id' => $rankDataArray['user_id'],
                    'invoice_id' => $rankDataArray['invoice_id'],
                    'wallet_type' => Constant::WALLET_TYPE['active_balance'],
                    'deb_amount' => 0,
                    'cred_amount' => 0,
                    'cred_point' => $this->rankCommissionCalculate($rankDataArray)['team_commission'] ?? 0,
                    'deb_point' => 0,
                    'status' => Constant::STATUS['approved'],
                    'in_status' => Constant::IN_STATUS['active'],
                    'transaction_type' => Constant::TRANSACTION_TYPE['sell_commission'],
                    'transaction_note' => 'Sell Commission for Invoice '.$rankDataArray['invoice_id'].' To '.$rankDataArray['username'],
                    'currency' => Constant::CURRENCY['name'],
                    'date' => time(),
                ]);
            }
        }

        return $transaction;
    }
}
