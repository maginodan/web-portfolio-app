<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('abouts')->insert([
            'name' => 'Magino Daniel',
            'role' => 'Full-Stack Web Developer',
            'greeting' => "Hi, I'm",
            'home_image' => '285a7244-aebd-4dbf-9d31-69c9a0ca0aa5.webp',
            'banner_image' => '34e32e39-f618-4ab2-b409-cd8d641f29cf.webp',
            'phone' => '0772 842 33166',
            'email' => 'maginodan@gmail.com',
            'address' => 'Kampala, Uganda',
            'description' => 'I build fast, reliable web applications from the ground up — designing clean interfaces on the frontend and engineering robust, scalable systems on the backend. Every project is built to solve real problems, not just look good.',
            'summary' => "I'm a full-stack web developer who enjoys working across the entire product lifecycle — from architecting databases and APIs to designing the interfaces people actually use every day. Over the years, I've built everything from lightweight marketing sites to complex backend systems handling real business logic, always with a focus on writing code that's clean, maintainable, and built to last. What drives me is solving problems end-to-end: understanding what a business actually needs, then shipping something that works reliably and feels good to use.",
            'tagline' => 'FullStack Web developer...',
            'availability_text' => 'Available for new projects',
            'cv' => 'resume.pdf',
            'created_at' => null,
            'updated_at' => now(),
        ]);
    }
}