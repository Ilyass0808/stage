<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            ['name' => 'Jean Dupont', 'email' => 'jean.dupont@gmail.com'],
            ['name' => 'Marie Curie', 'email' => 'marie.curie@gmail.com'],
            ['name' => 'Client Test', 'email' => 'client@gmail.com'],
        ];

        foreach ($clients as $client) {
            User::updateOrCreate(
                ['email' => $client['email']],
                [
                    'name' => $client['name'],
                    'password' => Hash::make('password'),
                    'role' => 'client'
                ]
            );
        }
    }
}
