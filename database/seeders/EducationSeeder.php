<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('education')->insert([
            [
                'institution' => 'Germany — Institute',
                'period' => '2014 — 2017',
                'degree' => 'Web Development',
                'department' => 'Computer Science',
                'description' => 'Comprehensive training in modern web development technologies and methodologies.',
                'created_at' => null,
                'updated_at' => now(),
            ],
            [
                'institution' => 'Germany — University',
                'period' => '2010 — 2012',
                'degree' => 'Computer Security',
                'department' => 'Computer Security',
                'description' => 'Specialized studies in computer and network security principles and practices.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'institution' => 'Germany — Institute',
                'period' => '2008 — 2010',
                'degree' => 'Computer Science',
                'department' => 'Computer Science',
                'description' => 'Foundation in computer science theory, algorithms, and software engineering.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}