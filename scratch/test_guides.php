<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Guide;

echo "Guides count in DB: " . Guide::count() . "\n";
foreach (Guide::all() as $g) {
    echo "- ID: {$g->id} | Title: " . ($g->title['tr'] ?? '') . " | Img: " . $g->img . " | Slug: " . ($g->slug_tr ?? '') . "\n";
}
