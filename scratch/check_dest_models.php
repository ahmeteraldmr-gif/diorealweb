<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;
use App\Models\Guide;

echo "Destinations count: " . Destination::count() . "\n";
foreach (Destination::all() as $d) {
    echo "- Destination ID: {$d->id} | Name: " . ($d->name['tr'] ?? '') . " | Slug: " . ($d->slug_tr ?? '') . "\n";
}

echo "\nGuides count: " . Guide::count() . "\n";
foreach (Guide::all() as $g) {
    echo "- Guide ID: {$g->id} | Title: " . ($g->title['tr'] ?? '') . " | Slug: " . ($g->slug_tr ?? '') . "\n";
}
