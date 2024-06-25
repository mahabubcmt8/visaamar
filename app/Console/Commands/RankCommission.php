<?php

namespace App\Console\Commands;

use App\Helpers\Constant;
use App\Helpers\Traits\GiveRankCommissionTrait;
use App\Helpers\Traits\RankCalculationTrait;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Console\Command;

class RankCommission extends Command
{
    use RankCalculationTrait, GiveRankCommissionTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rank-commission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = $this->setKey(User::with('rank')->get());
        $invoices = Invoice::where('status', Constant::STATUS['approved'])->where('order_status', Constant::ORDER_STATUS['deliverd'])->where('commission_status', Constant::INVOICE_COMMISSION_STATUS['no'])->where('type', Constant::ORDER_TYPE['customer'])->get();
        foreach($invoices as $invoice){
            $user = User::find($invoice->user_id);
            $agent = $users[$invoice->agent_id];
            $rankDataArray = [
                'user_id' => $invoice->user_id,
                'invoice_id' => $invoice->id,
                'bill_amount' => $invoice->bill_amount,
                'total_point' => $invoice->total_point,
                'agent' => $agent->username,
                'username' => $user->username,
                'user_rank' => isset($user->rank->rank_name) ? $user->rank->rank_name : "unknown",
                'self_bonus' => isset($user->rank->self_bonus) ? $user->rank->self_bonus : "0",
                'team_bonus' => isset($user->rank->team_bonus) ? $user->rank->team_bonus : "0",
            ];

            $this->rankCommission($rankDataArray, $users);

            $invoice->commission_status = Constant::INVOICE_COMMISSION_STATUS['yes'];
            $invoice->save();
        }

        exit("rank commission completed");
        return false;
    }
}
