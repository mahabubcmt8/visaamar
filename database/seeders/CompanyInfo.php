<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComapanyInfo;
use Illuminate\Support\Facades\Hash;

class CompanyInfo extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        ComapanyInfo::create(
            [
                'system_name' => 'Test System Name',
                'website_logo' => 'ayur-grean-website-logo-412.gif',
                'user_logo' => 'ayur-grean-user-logo-71.gif',
                'admin_logo' => 'ayur-grean-admin-logo-294.gif',
                'favicon' => 'ayur-grean-favicon-314.gif',
                'timezone' => 'Asia/Dhaka',
                'company_name' => 'Test Company Name',
                'site_mettro' => 'Test Company Name',
                'meta_title' => 'Test Company Name',
                'meta_des' => 'Test Company Name',
                'meta_keywords' => 'Test Company Name',
                'meta_image' => 'ayur-grean-website-logo-412.gif',
                'created_at' => now()
            ]
        );


    }
}
