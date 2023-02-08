<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sitesetting = SiteSetting::create([
            'mobile_login_icon' => "mobile_login_icon.png",
            'web_login_icon' => 'web_login_icon.png',
            'mobile_loading_icon' => 'mobile_loading_icon.png',
            'web_register_icon' => 'web_register_icon.png',
            'web_icon' => 'web_icon.png',
            'web_tab_icon' => 'web_tab_icon.png',
            'facebook_url' => 'www.google.com',
            'instagram_url' => 'www.google.com',
            'youtube_url' => 'www.google.com',
            'linkedin_url'=> 'www.google.com',
            'phonenumber' => 'www.google.com',
            'address' => 'no.532/542, Mahabandoola Road',
            'short_description' => 'www.google.com',
            'email' => 'sample.gmail.com'
        ]);
    }
}
