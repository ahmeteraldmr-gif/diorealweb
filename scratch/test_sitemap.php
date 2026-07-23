<?php

use Illuminate\Support\Facades\Request;

require __DIR__ . '/../bootstrap/app.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $response = App::call([App\Http\Controllers\SitemapController::class, 'index']);
    echo "Sitemap status: " . $response->getStatusCode() . PHP_EOL;
    echo substr($response->getContent(), 0, 500) . PHP_EOL;
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
