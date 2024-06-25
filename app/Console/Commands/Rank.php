<?php

namespace App\Console\Commands;

use App\Helpers\Traits\RankCalculationTrait;
use App\Models\Rank as ModelsRank;
use App\Models\User;
use Illuminate\Console\Command;

class Rank extends Command
{
    use RankCalculationTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rank';

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
        $user = User::with('purchase', 'referrals', 'rank')->where("status", 0)->get();

        $data = $this->setKey($user);
        $ranks = $this->rankSetKey(ModelsRank::all());

        foreach($data as $d){
            $this->getRank($ranks, $data, $d['username']);
        }

        exit("rank completed");
        return false;
    }
}
