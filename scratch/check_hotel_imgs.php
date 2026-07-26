<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;

$hotels = Hotel::all();
foreach ($hotels as $h) {
    $name = is_array($h->name) ? ($h->name['tr'] ?? '') : $h->name;
    echo "ID {$h->id}: {$name} -> img: {$h->img}\n";
}
