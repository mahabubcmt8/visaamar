<?php

namespace Database\Seeders;

use App\Models\ClubBonusDetailsAsset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubBonusDetailsAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClubBonusDetailsAsset::insert(
            [
                [
                    'club_id' => '1',
                    'rank_id' => '2',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '1',
                    'rank_id' => '3',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '1',
                    'rank_id' => '4',
                    'bonus' => '2.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '1',
                    'rank_id' => '5',
                    'bonus' => '2.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '1',
                    'rank_id' => '6',
                    'bonus' => '2.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '1',
                    'rank_id' => '7',
                    'bonus' => '2.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '2',
                    'rank_id' => '2',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '2',
                    'rank_id' => '3',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '2',
                    'rank_id' => '4',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '2',
                    'rank_id' => '5',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '2',
                    'rank_id' => '6',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '2',
                    'rank_id' => '7',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '3',
                    'rank_id' => '5',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '3',
                    'rank_id' => '6',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'club_id' => '3',
                    'rank_id' => '7',
                    'bonus' => '1.00',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]

            ]
        );
    }
}
