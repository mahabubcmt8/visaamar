<?php
namespace Database\Seeders;

use App\Helpers\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::insert(
            [
                [
                    'name' => 'User',
                    'username' => 'user',
                    'phone' => '123456789',
                    'refer' => 'refer',
                    'agent' => 'agent',
                    'email' => 'user@mail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'),
                    'show_password' => '12345678',
                    'status' => Constant::USER_STATUS['active'],
                    'type' => Constant::USER_TYPE['user'],
                    'created_at' => now()
                ],
                [
                    'name' => 'Agent',
                    'username' => 'agent',
                    'phone' => '123456789',
                    'refer' => 'refer',
                    'agent' => 'agent',
                    'email' => 'user@mail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'),
                    'show_password' => '12345678',
                    'status' => Constant::USER_STATUS['active'],
                    'type' => Constant::USER_TYPE['agent'],
                    'created_at' => now()
                ]
            ]
        );


    }
}
