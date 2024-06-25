<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rank::insert(
           [
            [
                'name' => 'Customer',
                'ap' => '0.0000000000',
                'group_sales' => '4.0000000000',
                'commission' => '10.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Distributor',
                'ap' => '0.0000000000',
                'group_sales' => '2.0000000000',
                'commission' => '12.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Leader',
                'ap' => '0.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '15.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sales Manager',
                'ap' => '100.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '18.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Silver Director',
                'ap' => '150.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '21.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gold Director',
                'ap' => '200.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '24.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Platinum Director',
                'ap' => '250.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '27.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Crown Director',
                'ap' => '250.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '30.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ruby Director',
                'ap' => '300.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '33.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diamond Director',
                'ap' => '300.0000000000',
                'group_sales' => '3.0000000000',
                'commission' => '36.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Star Ambassador',
                'ap' => '300.0000000000',
                'group_sales' => '2.0000000000',
                'commission' => '38.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Brand Ambassador',
                'ap' => '300.0000000000',
                'group_sales' => '2.0000000000',
                'commission' => '40.0000000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           ]
        );
    }
}
