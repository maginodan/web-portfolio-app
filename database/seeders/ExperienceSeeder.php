<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('experiences')->insert([
            [
                'company' => 'Apple Inc-Germany',
                'period' => '2012 — 2024',
                'position' => 'Software Engineer',
                'description' => 'Contributed to large-scale software engineering projects, collaborating across teams to deliver robust solutions.',
                'created_at' => null,
                'updated_at' => now(),
            ],
            [
                'company' => 'Samsung',
                'period' => '2008 — 2010',
                'position' => 'Developer',
                'description' => 'Developed and maintained web applications, working with modern technologies across the stack.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company' => 'Tesla Company',
                'period' => '2018 — 2021',
                'position' => 'Designer',
                'description' => 'Designed user interfaces and visual experiences, bridging the gap between design and development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}