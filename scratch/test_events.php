<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Event;

echo "Events count in DB: " . Event::count() . "\n";
foreach (Event::all() as $e) {
    echo "- ID: {$e->id} | Title: " . ($e->title['tr'] ?? '') . " | Img: " . $e->img . " | Slug: " . ($e->slug_tr ?? '') . "\n";
}
