<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Yacht;

echo "Yachts count in DB: " . Yacht::count() . "\n";
foreach (Yacht::all() as $y) {
    echo "- Name: " . ($y->name['tr'] ?? '') . " | Img: " . $y->img . " | Slug: " . ($y->slug_tr ?? '') . "\n";
}
