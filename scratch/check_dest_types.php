<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;

echo "Destinations count: " . Destination::count() . "\n";
foreach (Destination::all() as $d) {
    echo "- ID {$d->id}: {$d->name['tr']} | Type: " . ($d->type ?? 'NULL') . "\n";
}
