<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $products = [
            // PC Portables (Cat 1)
            [
                'name' => 'MacBook Pro 16" M3 Space Black', 'category_id' => 1, 'price' => 32900.00, 'stock' => 15, 
                'desc' => 'Le nec plus ultra pour les professionnels de la création. Écran Liquid Retina XDR, puce M3 Max.',
                'image_url' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800&q=80',
                'is_new' => true, 'is_promo' => false
            ],
            [
                'name' => 'Dell XPS 13 Plus', 'category_id' => 1, 'price' => 18500.00, 'stock' => 20, 
                'desc' => 'Un ultra-portable au design futuriste. Touchpad invisible et écran OLED bord à bord.',
                'image_url' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=800&q=80',
                'is_new' => false, 'is_promo' => true
            ],
            [
                'name' => 'Asus ROG Zephyrus G14', 'category_id' => 1, 'price' => 21000.00, 'stock' => 5, 
                'desc' => 'Pour les gamers exigants à la recherche de mobilité sans aucun compromis sur les FPS.',
                'image_url' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=800&q=80',
                'is_new' => true, 'is_promo' => true
            ],

            // PC Desktops (Cat 1)
            [
                'name' => 'PC Gamer ROG Strix Desktop', 'category_id' => 1, 'price' => 24500.00, 'stock' => 5, 
                'desc' => 'PC de bureau ultra-puissant pour le gaming. RTX 4080, 32GB RAM, refroidissement liquide.',
                'image_url' => 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=800&q=80',
                'is_new' => true, 'is_promo' => false
            ],
            [
                'name' => 'iMac 24" M3 Blue', 'category_id' => 1, 'price' => 16500.00, 'stock' => 10, 
                'desc' => 'L\'ordinateur tout-en-un emblématique d\'Apple. Design fin et coloré.',
                'image_url' => 'https://images.unsplash.com/photo-1517059224940-d4af9eec41b7?w=800&q=80',
                'is_new' => false, 'is_promo' => false
            ],

            // Smartphones (Cat 2)
            [
                'name' => 'iPhone 15 Pro Max', 'category_id' => 2, 'price' => 16500.00, 'stock' => 30, 
                'desc' => 'Châssis en titane, puce A17 Pro et appareil photo révolutionnaire avec zoom optique 5x.',
                'image_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800&q=80',
                'is_new' => true, 'is_promo' => false
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra', 'category_id' => 2, 'price' => 14900.00, 'stock' => 25, 
                'desc' => 'Intégration poussée de Galaxy AI, écran sublime et S-Pen inclus pour la productivité.',
                'image_url' => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=800&q=80',
                'is_new' => true, 'is_promo' => true
            ],

            // Tablettes (Cat 3)
            [
                'name' => 'iPad Pro 12.9" M2', 'category_id' => 3, 'price' => 15900.00, 'stock' => 12, 
                'desc' => 'L\'ordinateur tactile par excellence. Brillant pour les artistes digitaux et le montage vidéo.',
                'image_url' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=800&q=80',
                'is_new' => false, 'is_promo' => false
            ],

            // Audio (Cat 4)
            [
                'name' => 'Sony WH-1000XM5', 'category_id' => 4, 'price' => 4200.00, 'stock' => 50, 
                'desc' => 'La meilleure réduction de bruit active du marché à l\'heure actuelle.',
                'image_url' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=800&q=80',
                'is_new' => true, 'is_promo' => false
            ],

            // Périphériques & Accessoires (Cat 5)
            [
                'name' => 'Logitech MX Master 3S', 'category_id' => 5, 'price' => 1300.00, 'stock' => 45, 
                'desc' => 'La souris ergonomique sans-fil de référence pour les graphistes et développeurs.',
                'image_url' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=800&q=80',
                'is_new' => false, 'is_promo' => true
            ],
            [
                'name' => 'Clavier Keychron K2', 'category_id' => 5, 'price' => 1100.00, 'stock' => 25, 
                'desc' => 'Clavier mécanique compact (75%) avec switchs interchangeables, Bluetooth et filaire.',
                'image_url' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?w=800&q=80',
                'is_new' => false, 'is_promo' => false
            ],
            [
                'name' => 'Chargeur Ugreen Nexode 100W', 'category_id' => 5, 'price' => 750.00, 'stock' => 80, 
                'desc' => 'Technologie GaN: compact et puissant pour recharger PC, mobile et tablette en simultané.',
                'image_url' => 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=800&q=80',
                'is_new' => true, 'is_promo' => true
            ],

            // Composants PC (Cat 6)
            [
                'name' => 'RAM Corsair Vengeance 32GB DDR5', 'category_id' => 6, 'price' => 1800.00, 'stock' => 40, 
                'desc' => 'Mémoire haute performance pour les joueurs et créateurs.',
                'image_url' => 'https://images.unsplash.com/photo-1562976540-1502c2145186?w=800&q=80',
                'is_new' => true, 'is_promo' => false
            ],
            [
                'name' => 'SSD Samsung 980 PRO 1TB', 'category_id' => 6, 'price' => 1200.00, 'stock' => 60, 
                'desc' => 'Disque dur SSD NVMe PCIe 4.0 ultra rapide pour PC et PS5.',
                'image_url' => 'https://images.unsplash.com/photo-1597852074816-d933c7d2b988?w=800&q=80',
                'is_new' => false, 'is_promo' => true
            ],
            [
                'name' => 'Processeur Intel Core i9-14900K', 'category_id' => 6, 'price' => 6500.00, 'stock' => 15, 
                'desc' => 'Le processeur ultime pour le gaming et le multitâche.',
                'image_url' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?w=800&q=80',
                'is_new' => true, 'is_promo' => false
            ],
            [
                'name' => 'Carte Graphique NVIDIA RTX 4090', 'category_id' => 6, 'price' => 22000.00, 'stock' => 3, 
                'desc' => 'La carte graphique la plus puissante du monde.',
                'image_url' => 'https://images.unsplash.com/photo-1555617766-c94804975da3?w=800&q=80',
                'is_new' => true, 'is_promo' => false
            ],

            // Écrans (Cat 7)
            [
                'name' => 'Écran Dell UltraSharp 27" 4K', 'category_id' => 7, 'price' => 5500.00, 'stock' => 20, 
                'desc' => 'Moniteur professionnel avec une précision des couleurs exceptionnelle.',
                'image_url' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=800&q=80',
                'is_new' => false, 'is_promo' => false
            ]
        ];

        Storage::disk('public')->makeDirectory('products');

        foreach ($products as $idx => $prod) {
            $imagePath = null;
            
            try {
                $response = Http::timeout(30)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    ])
                    ->withoutVerifying()
                    ->get($prod['image_url']);
                
                if ($response->successful()) {
                    $imageName = 'product_' . Str::slug($prod['name']) . '_' . time() . '.jpg';
                    Storage::disk('public')->put('products/' . $imageName, $response->body());
                    $imagePath = 'products/' . $imageName;
                } else {
                    $imagePath = 'products/cat_' . $prod['category_id'] . '.jpg';
                }
            } catch (\Exception $e) {
                $imagePath = 'products/cat_' . $prod['category_id'] . '.jpg';
            }

            Product::create([
                'name' => $prod['name'],
                'category_id' => $prod['category_id'],
                'price' => $prod['price'],
                'stock' => $prod['stock'],
                'description' => $prod['desc'],
                'image' => $imagePath,
                'is_new' => $prod['is_new'],
                'is_promo' => $prod['is_promo']
            ]);
        }
    }
}
