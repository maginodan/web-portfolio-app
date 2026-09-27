<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'Jay Smith',
                'function' => 'Customer',
                'testimony' => 'I am really impressed with the school management system he built for my school, thank you',
                'rating' => '4',
                'image' => '1789420231.png',
                'created_at' => null,
                'updated_at' => now(),
            ],
            [
                'name' => 'staicy jane',
                'function' => 'Customer',
                'testimony' => 'He built me a nice website that has attracted in more customers to my business, Thanks Daniel',
                'rating' => '5',
                'image' => '1789420303.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andrew Colins',
                'function' => 'Marketing Manager',
                'testimony' => 'he optimized our database that was slow and now its functioning faster than it was initially thanks Dan!',
                'rating' => '5',
                'image' => '1789420355.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarah Namutebi',
                'function' => 'Fintech Startup',
                'testimony' => 'Magino delivered our MVP two weeks ahead of schedule without cutting any corners on quality.',
                'rating' => '5',
                'image' => '1789511118.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Okello',
                'function' => 'Founder, RetailHub Uganda',
                'testimony' => 'We came to Magino with a messy legacy codebase and a tight deadline.',
                'rating' => '5',
                'image' => '1789511369.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amara Chen',
                'function' => 'UI/UX Lead, Bright Studio',
                'testimony' => 'Great eye for translating designs into pixel-accurate, responsive interfaces.There were a couple of minor revisions needed on mobile',
                'rating' => '4',
                'image' => '1789511964.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'James Kato',
                'function' => 'CTO, AgriConnect',
                'testimony' => 'Magino built our farmer marketplace API from scratch and it has handled scale far better than we expected.',
                'rating' => '5',
                'image' => '1789512449.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}