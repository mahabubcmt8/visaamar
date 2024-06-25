<?php

namespace Database\Seeders;

use App\Models\ClubBonusDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubBonusDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClubBonusDetails::insert(
            [
                [
                    'name' => 'Development Bonus',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Car Fund Details',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'House Fund Bonus',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
