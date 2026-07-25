<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Journal;

echo "Journals count in DB: " . Journal::count() . "\n";
foreach (Journal::all() as $j) {
    echo "- ID: {$j->id} | Title: " . ($j->title['tr'] ?? '') . " | Img: " . $j->img . " | Slug: " . ($j->slug_tr ?? '') . "\n";
}
