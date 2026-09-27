<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'name' => 'UI/UX Designer',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 19l7-7 3 3-7 7-3-3zM18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5zM2 2l7.586 7.586" stroke-linecap="round" stroke-linejoin="round"/><circle cx="11" cy="11" r="2"/></svg>',
                'description' => 'Creating great UI/UX brands with thoughtful design systems and user-centered interfaces.',
                'created_at' => null,
                'updated_at' => now(),
            ],
            [
                'name' => 'Frontend Developer',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 17l6-6-6-6M12 19h8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                'description' => 'Creating engaging frontend interactions with modern JavaScript and responsive frameworks.',
                'created_at' => null,
                'updated_at' => now(),
            ],
            [
                'name' => 'Backend Developer',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><path d="M6 6h.01M6 18h.01" stroke-linecap="round"/></svg>',
                'description' => 'Building robust backend logic and APIs that power reliable, scalable web applications.',
                'created_at' => null,
                'updated_at' => now(),
            ],
            [
                'name' => 'Branding Design',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18h6M10 22h4M12 2a7 7 0 0 0-4 12.7V17h8v-2.3A7 7 0 0 0 12 2z" stroke-linecap="round" stroke-linejoin="round"></path></svg>',
                'description' => 'Creating intuitive brands with cohesive visual identities and memorable design language.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}