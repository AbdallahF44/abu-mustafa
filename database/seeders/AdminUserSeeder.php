<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin@123456'),
                'is_admin' => true,
            ]
        );
        User::updateOrCreate(
            [
                'email' => 'abdallah@gmail.com',
            ],
            [
                'name' => 'Abdallah',
                'password' => Hash::make('Abdallah@4444'),
                'is_admin' => true,
            ]
        );
    }
}