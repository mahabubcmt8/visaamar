<?php

namespace App\Helpers\Traits;
use App\Models\User;
// use App\Models\Generation;
use Generator;
use App\Models\Rank;
use App\Models\Rank2;

trait RankCalculationTrait{
    // public function rankCalculate($username){
    //     $level=[];
    //     $generation=Generation::all();
    //     $user=User::with('referralsRecursive')->where('username','noman5')->first();
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

    public function rankUserCount($data, $username){
        $user = $data[$username]->referrals;
        $ranksCount = array(
            'customer' => 0,
            'distributor' => 0,
            'leader' => 0,
            'sales_manager' => 0,
            'silver_director' => 0,
            'gold_director' => 0,
            'platinum_director' => 0,
            'crown_director' => 0,
            'ruby_director' => 0,
            'diamond_director' => 0,
            'star_ambassador' => 0,
            'brand_ambassador' => 0,
        );

        foreach ($user as $usr) {
            $rankName = $data[$usr['username']]->rank->rank_name ?? null;
            if ($rankName) {
                switch ($rankName) {
                    case 'customer':
                    case 'distributor':
                    case 'leader':
                    case 'sales_manager':
                    case 'silver_director':
                    case 'gold_director':
                    case 'platinum_director':
                    case 'crown_director':
                    case 'ruby_director':
                    case 'diamond_director':
                    case 'star_ambassador':
                    case 'brand_ambassador':
                        $ranksCount[$rankName]++;
                    break;
                }
            }
        }
        return $ranksCount;
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

    public function rankSetKey($data){
        $arr = [];
        foreach ($data as $item) {
            $arr[$item['id']] = $item;
        }
        return $arr;
    }

    public function getRank($ranks, $data, $username){
        // $startTime = microtime(true);

        $usr = $data[$username];
        $user_deposit = $usr->purchase->sum('deb_amount');
        $user_point = ($usr->purchase->sum('cred_point') - $usr->purchase->sum('deb_point'));
        // get first levels generations
        $links = [];
        foreach($usr->referrals as $refs){
            $gen = $this->countGeneration($data,$refs->username);
            $dep = $data[$refs->username]->purchase->sum('deb_amount');

            array_push($links,['username' => $refs->username, 'team_sales' => ($gen['total'] + $refs->purchase->sum('deb_amount')), 'team_point' => ($gen['point'] + ($refs->purchase->sum('cred_point') - $refs->purchase->sum('deb_point')))]);
        }
        usort($links,array($this, 'compareDeposits'));
        $links;

        $get = ['username' => $username, 'links' => $links];
        // return $get;

        // $user_rank=Rank::where('username',$username)->latest()->first();
        $user_rank = isset($data[$username]->rank->rank_name) ? $data[$username]->rank->rank_name : "unknown";
        $ranksCount = $this->rankUserCount($data, $username);

        $total_team_sales = array_sum(array_column($links, 'team_sales'));
        $total_team_point = array_sum(array_column($links, 'team_point'));
        // Add the total sum of team_sales amounts to the result
        $result = [
            'username' => $username,
            'total_team_sales' => $total_team_sales,
            'total_team_point' => $total_team_point,
            'total_self_sales' => $user_deposit,
            'total_self_point' => $user_point,
            'links' => $links,
            'ranksCount' => $ranksCount,
        ];

        // $endTime = microtime(true);

        if($result == true){
            $team_sales = $result['total_team_sales'];
            $team_point = $result['total_team_point'];
            $self_sales = $result['total_self_sales'];
            $self_point = $result['total_self_point'];

            switch (true) {
                case ($user_rank !== 'customer' and $team_point >= 0 and $team_point <= 500) :
                    $rank = new Rank2;
                    $rank->rank_name = 'customer';
                    $rank->rank_id = $ranks['1']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['1']['commission'];
                    $rank->team_bonus = $ranks['1']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'distributor' and $team_point >= 501 and $team_point <= 1500:
                    $rank = new Rank2;
                    $rank->rank_name = 'distributor';
                    $rank->rank_id = $ranks['2']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['2']['commission'];
                    $rank->team_bonus = $ranks['2']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'leader' and $team_point >= 1501 and $team_point <= 3000:
                    $rank = new Rank2;
                    $rank->rank_name = 'leader';
                    $rank->rank_id = $ranks['3']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['3']['commission'];
                    $rank->team_bonus = $ranks['3']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'sales_manager' and $self_point >= $ranks['4']['ap'] and $team_point >= 3001 and $team_point <= 5000:
                    $rank = new Rank2;
                    $rank->rank_name = 'sales_manager';
                    $rank->rank_id = $ranks['4']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['4']['commission'];
                    $rank->team_bonus = $ranks['4']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'silver_director' and $self_point >= $ranks['5']['ap'] and $team_point >= 5001 and $result['ranksCount']['sales_manager'] >= 3 and $result['ranksCount']['sales_manager'] < 6:
                    $rank = new Rank2;
                    $rank->rank_name = 'silver_director';
                    $rank->rank_id = $ranks['5']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['5']['commission'];
                    $rank->team_bonus = $ranks['5']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'gold_director' and $self_point >= $ranks['6']['ap'] and $team_point >= 5001 and $result['ranksCount']['sales_manager'] >= 6  and $result['ranksCount']['sales_manager'] < 9:
                    $rank = new Rank2;
                    $rank->rank_name = 'gold_director';
                    $rank->rank_id = $ranks['6']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['6']['commission'];
                    $rank->team_bonus = $ranks['6']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'platinum_director' and $self_point >= $ranks['7']['ap'] and $team_point >= 5001 and $result['ranksCount']['sales_manager'] >= 9 and $result['ranksCount']['silver_director'] < 2:
                    $rank = new Rank2;
                    $rank->rank_name = 'platinum_director';
                    $rank->rank_id = $ranks['7']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['7']['commission'];
                    $rank->team_bonus = $ranks['7']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'crown_director' and $self_point >= $ranks['8']['ap'] and $team_point >= 5001 and $result['ranksCount']['silver_director'] >= 2 and $result['ranksCount']['silver_director'] < 4:
                    $rank = new Rank2;
                    $rank->rank_name = 'crown_director';
                    $rank->rank_id = $ranks['8']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['8']['commission'];
                    $rank->team_bonus = $ranks['8']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'ruby_director' and $self_point >= $ranks['9']['ap'] and $team_point >= 5001 and $result['ranksCount']['silver_director'] >= 4 and $result['ranksCount']['silver_director'] < 6:
                    $rank = new Rank2;
                    $rank->rank_name = 'ruby_director';
                    $rank->rank_id = $ranks['9']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['9']['commission'];
                    $rank->team_bonus = $ranks['9']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'diamond_director' and $self_point >= $ranks['10']['ap'] and $team_point >= 5001 and $result['ranksCount']['silver_director'] >= 6 and $result['ranksCount']['gold_director'] < 3:
                    $rank = new Rank2;
                    $rank->rank_name = 'diamond_director';
                    $rank->rank_id = $ranks['10']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['10']['commission'];
                    $rank->team_bonus = $ranks['10']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'star_ambassador' and $self_point >= $ranks['11']['ap'] and $team_point >= 5001 and $result['ranksCount']['gold_director'] >= 3 and $result['ranksCount']['diamond_director'] < 2:
                    $rank = new Rank2;
                    $rank->rank_name = 'star_ambassador';
                    $rank->rank_id = $ranks['11']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['11']['commission'];
                    $rank->team_bonus = $ranks['11']['group_sales'];
                    $rank->save();
                break;
                case $user_rank !== 'brand_ambassador' and $self_point >= $ranks['12']['ap'] and $team_point >= 5001 and $result['ranksCount']['diamond_director'] >= 2:
                    $rank = new Rank2;
                    $rank->rank_name = 'brand_ambassador';
                    $rank->rank_id = $ranks['12']['id'];
                    $rank->username = $username;
                    $rank->team_sales = $team_sales;
                    $rank->team_point = $team_point;
                    $rank->team_earning = 0;
                    $rank->self_sales = $self_sales;
                    $rank->self_point = $self_point;
                    $rank->self_earning = 0;
                    $rank->self_bonus = $ranks['12']['commission'];
                    $rank->team_bonus = $ranks['12']['group_sales'];
                    $rank->save();
                break;
                default:
                    return false;
                break;
            }
            // return $ranks['1'];
        }
        // $executionTime = $endTime - $startTime;
        return false;
    }

    public function compareDeposits($a, $b) {
        return $b["team_sales"] - $a["team_sales"];
    }

}
