<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Premier Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        // Deuxième Admin (Ilyass)
        User::updateOrCreate(
            ['email' => 'ilyass@gmail.com'],
            [
                'name' => 'Ilyass Admin',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );
    }
}
