<?php

namespace App\Helpers\Traits;
use App\Models\User;
use App\Models\Rank;
trait GenInvestCounterTrait{

    // public function countGeneration2($data, $username)
    // {
    //     $level = $data[$username]->referrals;
    //     $level_all=[];
    //     $level_all = [];
    //     $level_all['level0'] = [];
    //     $level_all['level1']=[];
    //     $total_invest = 0;
    //     $total_invest_point = 0;

    //     foreach ($level as $lv1) {
    //         // Check if the 'purchase' relationship is not null
    //         if ($lv1->purchase) {
    //             $total_invest += floatval($lv1->purchase->sum('deb_amount'));
    //             $total_invest_point += floatval($lv1->purchase->sum('cred_point'));
    //             $level_all['level0'] = array_merge($level_all['level0'], [['username' => $lv1->username, 'deposit' => ($lv1->purchase->sum('deb_amount') - $lv1->purchase->sum('cred_amount')), 'point' => ($lv1->purchase->sum('cred_point') - $lv1->purchase->sum('deb_point'))]]);
    //             $find = $this->FindUserCount($data, $lv1->username);
    //             $level_all['level1'] = array_merge($level_all['level1'], $find['user']);
    //         }
    //     }

    //     // Rest of your code...

    //     return ['level_all' => $level_all, 'total' => $total_invest, 'point' => $total_invest_point];
    // }

    public function countGeneration($data, $username){
        $level = $data[$username]->referrals;
        $level_all = [];
        $level_all['level0'] = [];
        $level_all['level1'] = [];
        $total_invest = 0;
        $total_invest_point = 0;

        foreach($level as $lv1){
            $total_invest += floatval($lv1->purchase->sum('deb_amount'));
            $total_invest_point += floatval($lv1->purchase->sum('cred_point'));

            $level_all['level0'] = array_merge($level_all['level0'], [ ['username' => $lv1->username, 'deposit' => ($lv1->purchase->sum('deb_amount')-$lv1->purchase->sum('cred_amount')), 'point' => ($lv1->purchase->sum('cred_point') - $lv1->purchase->sum('deb_point'))]]);

            $find = $this->FindUserCount($data,$lv1->username);
            $level_all['level1'] = array_merge($level_all['level1'], $find['user']);
        }
        for($i = (count($level_all) - 2); count($level_all['level'.$i]) > 0; $i++){
            $level_all['level'.$x=($i+1)]=[];

            foreach($level_all['level'.$i] as $d){

                $find = $this->FindUserCount($data, $d['username']);
                $total_invest += floatval($find['total']);
                $total_invest_point += floatval($find['point']);
                $level_all['level'.$x= ($i + 1)] = array_merge($level_all['level'.$x= ($i + 1)], $find['user']);
            }
            if(!count($level_all)){
                break;
            }
            // break;
        }
        // return $level_all;

        return ['level_all' => $level_all, 'total' => $total_invest, 'point' => $total_invest_point];
    }


    public function FindUserCount($data, $username){
        $arr = [];
        $total = 0;
        $point = 0;
            // $user=User::with('deposit')->where('reffer_by',$username)->get();
            $user = $data[$username]->referrals;
            foreach($user as $usr){
                $total += $usr->purchase->sum('deb_amount') - $usr->purchase->sum('cred_amount');
                $point += $usr->purchase->sum('cred_point') - $usr->purchase->sum('deb_point');

                $arr[] = ['username' => $usr->username, 'deposit' => ($usr->purchase->sum('deb_amount') - $usr->purchase->sum('cred_amount')), 'point' => ($usr->purchase->sum('cred_point') - $usr->purchase->sum('deb_point'))];
            }
        return ['user' => $arr, 'total' => $total, 'point' => $point];
    }

    public function setKey($data){
        $arr = [];
        foreach ($data as $item) {
            $arr[$item['username']] = $item;
        }
        return $arr;
    }

    public function getRank($data, $username){
        $startTime = microtime(true);
        // $data=User::with('deposit','referrals')->get();
        // $data=$this->setKey($data);
        $usr = $data[$username];
        $user_deposit = $usr->purchase->sum('deb_amount');
        $user_point = ($usr->purchase->sum('cred_point') - $usr->purchase->sum('deb_point'));
        // get first levels generations
        $links = [];
        foreach($usr->referrals as $refs){
            $gen = $this->countGeneration($data, $refs->username);
            $dep = $data[$refs->username]->purchase->sum('deb_amount');
            array_push($links,['username' => $refs->username, 'deposit' => ($gen['total'] + $refs->purchase->sum('deb_amount')), 'point' => ($gen['point'] + ($refs->purchase->sum('cred_point') - $refs->purchase->sum('deb_point')))]);
        }
        usort($links,array($this, 'compareDeposits'));
        $links;
        return $get = ['username' => $username, 'sales_amount' => $user_deposit, 'sales_point' => $user_point,'links' => $links];
        // return $get;
        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        // $user_rank=Rank::where('username',$username)->latest()->first();
        $user_rank = isset($data[$username]->rank->rank_name) ? $data[$username]->rank->rank_name : "unknown";
        //  info($user_rank);
        return false;
    }

    public function compareDeposits($a, $b) {
        return $b["deposit"] - $a["deposit"];
    }
}
