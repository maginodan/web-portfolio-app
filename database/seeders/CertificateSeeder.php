<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('certificates')->insert([
            [
                'image' => '1789416431.webp',
                'title' => 'CSS Certification',
                'description' => 'CSS certification course',
                'pdf' => '1789416151.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => '1789416640.webp',
                'title' => 'HTML Certification',
                'description' => 'Programming Hub certificate',
                'pdf' => '1789416640.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => '1789416809.webp',
                'title' => 'Django Development',
                'description' => 'Latest certificate for Django development',
                'pdf' => '1789416810.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => '1789417208.webp',
                'title' => 'Additional Certification',
                'description' => 'Programming Hub certificate',
                'pdf' => '1789417159.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}