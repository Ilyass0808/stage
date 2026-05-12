<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);
$kernel->handle(Request::capture());

try {
    $results = \Illuminate\Support\Facades\DB::select('SELECT 1');
    echo "Database connection successful!\n";
    print_r($results);
} catch (\Exception $e) {
    echo "Database connection failed!\n";
    echo $e->getMessage() . "\n";
}
