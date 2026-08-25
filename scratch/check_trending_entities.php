<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== HOTELS ===\n";
foreach (App\Models\Hotel::all() as $h) {
    echo "ID {$h->id}: " . json_encode($h->name, JSON_UNESCAPED_UNICODE) . " | slug_tr: {$h->slug_tr}\n";
}

echo "\n=== RESTAURANTS ===\n";
foreach (App\Models\Restaurant::all() as $r) {
    echo "ID {$r->id}: " . json_encode($r->name, JSON_UNESCAPED_UNICODE) . " | slug_tr: {$r->slug_tr}\n";
}

echo "\n=== YACHTS ===\n";
foreach (App\Models\Yacht::all() as $y) {
    echo "ID {$y->id}: " . json_encode($y->title, JSON_UNESCAPED_UNICODE) . " | slug_tr: {$y->slug_tr}\n";
}

echo "\n=== DESTINATIONS ===\n";
foreach (App\Models\Destination::all() as $d) {
    echo "ID {$d->id}: " . json_encode($d->name, JSON_UNESCAPED_UNICODE) . " | slug_tr: {$d->slug_tr}\n";
}

echo "\n=== GUIDES ===\n";
foreach (App\Models\Guide::all() as $g) {
    echo "ID {$g->id}: " . json_encode($g->title, JSON_UNESCAPED_UNICODE) . " | slug_tr: {$g->slug_tr}\n";
}
