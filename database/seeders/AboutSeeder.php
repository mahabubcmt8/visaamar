<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutSection::insert(
            [
                [
                //    'name' => 'User',
                //    'username' => 'user',
                //    'phone' => '123456789',
                //    'refer' => 'refer',
                //    'agent' => 'agent',
                //    'email' => 'user@mail.com',
                //    'email_verified_at' => now(),
                //    'password' => Hash::make('12345678'),
                //    'show_password' => '12345678',
                //    'status' => Constant::USER_STATUS['active'],
                //    'type' => Constant::USER_TYPE['user'],
                //    'created_at' => now()
                    'description' => 'fsklfsdkl',
                    'image' => 'Screenshot_9.png',
                    'created_at' => now(),
                ],

            ]
        );
    }
}
