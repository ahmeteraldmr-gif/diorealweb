<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Restaurant;

echo "Restaurants count in DB: " . Restaurant::count() . "\n";
foreach (Restaurant::all() as $r) {
    echo "- ID: {$r->id} | Name: " . ($r->name['tr'] ?? '') . " | Img: " . $r->img . " | Slug: " . ($r->slug_tr ?? '') . "\n";
}
