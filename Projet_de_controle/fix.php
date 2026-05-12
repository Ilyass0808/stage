<?php

// Remplacer € par Dhs
$viewDir = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$ite = new RecursiveIteratorIterator($viewDir);
foreach($ite as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, '€') !== false) {
            $content = str_replace('€', 'Dhs', $content);
            file_put_contents($file->getPathname(), $content);
        }
    }
}

// Réparer les 4 images manquantes
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$firstImage = App\Models\Product::whereNotNull('image')->first()->image ?? 'products/placeholder.jpg';
App\Models\Product::whereNull('image')->update(['image' => $firstImage]);

echo "Réparation terminée avec succès";
