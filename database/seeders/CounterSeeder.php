<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CounterSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('counters')->insert([
            [
                'number' => '05+',
                'label' => 'Years<br>experience',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'number' => '3+',
                'label' => 'Completed<br>projects',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'number' => '3+',
                'label' => 'Companies<br>worked',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}