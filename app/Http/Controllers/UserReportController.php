<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Helpers\Traits\GenInvestCounterTrait;
use App\Helpers\Traits\RowIndex;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Share;
use Yajra\DataTables\Facades\DataTables;


class UserReportController extends Controller
{
    use RowIndex;
    use GenInvestCounterTrait;

    public function index(){
        $pageTitle = 'My Refer List';
        $user = Auth::user();
        $shareBtn = Share::page(route('login').'?refer='.$user->username)
        ->facebook()
        ->telegram()
        ->whatsapp()
        ->getRawLinks();

        if (request()->ajax()) {
            $data = User::where('refer', Auth::user()->username);

            $dataCollection = $data;
            return DataTables::of($dataCollection)
                ->addColumn('sl', function ($row) {
                    return $this->dt_index($row);
                })
                ->addColumn('type', function ($row) {
                    return ucwords(array_flip(Constant::USER_TYPE)[$row->type]);
                })
                ->rawColumns(['sl', 'type'])
                ->make(true);
        }
        if($user->type == Constant::USER_TYPE['agent']){
            return view('user.page.refer.index', compact('pageTitle', 'shareBtn', 'user'));
        }
        else{
            return view('customer.page.refer.index', compact('pageTitle', 'shareBtn', 'user'));
        }
    }



    public function teamUserCount()
    {
        $pageTitle = 'My Team User Count';
        $user = Auth::user();

        $counts = $this->calculateTeamCounts($user, 1, 7);
        $myScore = 0;

        if ($user->type == Constant::USER_TYPE['agent']) {
            return view('user.page.team.index-count', compact(
                'pageTitle',
                'user',
                'counts',
                'myScore'
            ));
        }
        else {
            return view('customer.page.team.index-count', compact(
                'pageTitle',
                'user',
                'counts',
                'myScore'
            ));
        }
    }

    private function calculateTeamCounts($user, $level, $maxLevel)
    {
        if ($level > $maxLevel) {
            return [];
        }

        $referrals = User::where('refer', $user->username)->get();
        $countKey = "count_level_$level";
        $totalKey = "total_level_$level";

        $counts[$countKey][] = $referrals->count();
        $counts[$totalKey][] = $referrals->sum('amount');

        foreach ($referrals as $referral) {
            $counts += $this->calculateTeamCounts($referral, $level + 1, $maxLevel);
        }

        return $counts;
    }

    public function teamUserSales(){
        $pageTitle = "My Team Sales";
        $user = Auth::user();
        if ($user->type == Constant::USER_TYPE['agent']) {
            return view('user.page.team.sales', compact('pageTitle'));
        }
        else {
            return view('customer.page.team.sales', compact('pageTitle'));
        }

    }

    public function genInvest()
    {
        $user = User::with('purchase','referrals')->where('id', '>=', auth()->user()->id)->where("status", 0)->get();
        $data = $this->setKey($user);

        $all_data = $this->getRank($data, auth()->user()->username);
        return response()->json($all_data);
    }



}
