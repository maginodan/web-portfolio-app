<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoSettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('seo_settings')->insert([
            'meta_title' => 'Magino Daniel — Full-Stack Software Developer',
            'meta_description' => 'Full-stack Software developer building clean, scalable websites, APIs, databases, and business systems with a focus on maintainable, real-world solutions.',
            'meta_keywords' => 'full-stack web developer, Laravel developer, PHP developer, backend developer, frontend developer, web application development, API development, MySQL database, Tailwind CSS, responsive web design',
            'meta_author' => 'Magino Daniel',
            'og_image' => '1789520916_og.jpeg',
            'twitter_handle' => '@danmagino64',
            'canonical_url' => 'https://www.maginodaniel.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}