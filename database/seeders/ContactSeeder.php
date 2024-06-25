<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::insert(
        [
            [
                'address' => 'fsklfsdkl',
                'phone' => 'fsklfsdkl',
                'email' => 'fsklfsdkl',
                'facebook' => 'fsklfsdkl',
                'Instagram' => 'fsklfsdkl',
                'LinkedIn' => 'fsklfsdkl',
                'twitter' => 'fsklfsdkl',
                'Blogger' => 'fsklfsdkl',
                'WhatsApp' => 'fsklfsdkl',
                'image' => 'Screenshot_9.png',
                'created_at' => now(),
            ],

        ]
    );
    }
}
