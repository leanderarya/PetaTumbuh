<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Sesuaikan dengan model Anda

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Posyandu',
                'email' => 'admin@kalangdosari.com',
                'password' => Hash::make('admin12345'),
            ]
        );
    }
}