<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Ordinateurs', 'description' => 'PC Portables, PC de bureau (Desktops) et gamers.'],
            ['id' => 2, 'name' => 'Smartphones', 'description' => 'Les derniers modèles de téléphones intelligents et accessoires.'],
            ['id' => 3, 'name' => 'Tablettes', 'description' => 'Tablettes tactiles, liseuses et appareils de productivité mobile.'],
            ['id' => 4, 'name' => 'Audio', 'description' => 'Casques à réduction de bruit, écouteurs et enceintes Bluetooth.'],
            ['id' => 5, 'name' => 'Périphériques', 'description' => 'Souris, claviers mécaniques, chargeurs rapides et hub.'],
            ['id' => 6, 'name' => 'Composants PC', 'description' => 'RAM, SSD, Cartes Graphiques et Processeurs.'],
            ['id' => 7, 'name' => 'Écrans', 'description' => 'Moniteurs pour le travail, gaming et création.'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['id' => $cat['id']], $cat);
        }
    }
}
