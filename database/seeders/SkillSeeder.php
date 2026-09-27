<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('skills')->insert([
            ['name' => 'PHP', 'proficiency' => 90, 'service_id' => 3, 'created_at' => null, 'updated_at' => now()],
            ['name' => 'Python', 'proficiency' => 80, 'service_id' => 3, 'created_at' => null, 'updated_at' => now()],
            ['name' => 'JavaScript', 'proficiency' => 70, 'service_id' => 2, 'created_at' => null, 'updated_at' => now()],
            ['name' => 'Node.js', 'proficiency' => 80, 'service_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'React', 'proficiency' => 60, 'service_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HTML / CSS', 'proficiency' => 85, 'service_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Figma', 'proficiency' => 80, 'service_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Canva', 'proficiency' => 90, 'service_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brand Identity', 'proficiency' => 75, 'service_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Visual Design', 'proficiency' => 78, 'service_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}