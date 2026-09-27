<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'image' => '1789342488.webp',
                'title' => 'Project 1',
                'category' => 'AI',
                'description' => 'An AI-powered project leveraging modern web technologies.',
                'technologies' => 'JavaScript, AI',
                'link' => 'https://www.x.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => '1789342514.webp',
                'title' => 'Project 2',
                'category' => 'Backend',
                'description' => 'A full-stack web application built with modern backend and frontend tools.',
                'technologies' => 'PHP, Node.js',
                'link' => 'https://www.texas.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image' => '1789342529.webp',
                'title' => 'Modern Website Portfolio',
                'category' => 'Portfolio',
                'description' => 'A responsive website adaptable for all devices, built with modern web standards.',
                'technologies' => 'HTML, CSS, JavaScript',
                'link' => 'https://www.github.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}