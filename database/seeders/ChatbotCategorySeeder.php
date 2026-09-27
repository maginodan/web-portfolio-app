<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatbotCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('chatbot_categories')->insert([
            [
                'name' => 'Personal Information',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Contact',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}