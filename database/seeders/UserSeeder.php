<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Portfolio Admin',
                'password' => Hash::make('password123'),
                'bio' => 'Administrator account for managing the portfolio site.',
                'is_admin' => true,
                'image' => '1789419951',
                'email_verified_at' => null,
                'remember_token' => null,
            ]
        );
    }
}