<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('site_settings')->insert([
            'logo_light' => '1789485250_logo_light.svg',
            'logo_dark' => '1789484272_logo_dark.svg',
            'favicon' => '1789484272_favicon.svg',
            'footer_text' => 'Copyright © 2026 Magino Kent Daniel. All rights reserved.',

            'hcaptcha_site_key' => null,
            'hcaptcha_secret_key' => null,
            'hcaptcha_enabled' => false,

            'primary_color' => '#2563eb',

            'cookie_consent_enabled' => true,
            'cookie_consent_text' => 'We use cookies to improve your browsing experience, analyze site traffic, and personalize content. By clicking "Accept all", you consent to our use of cookies.',
            'cookie_accept_text' => 'Accept all',
            'cookie_decline_text' => 'Necessary only',
            'cookie_privacy_text' => 'Privacy Policy',
            'cookie_privacy_url' => null,

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}