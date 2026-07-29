<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;

$dests = Destination::all();
echo "Total Destinations: " . count($dests) . "\n";
foreach ($dests as $d) {
    $trName = is_array($d->name) ? ($d->name['tr'] ?? '') : $d->name;
    $type = $d->type ?? 'turkiye';
    $img = $d->img ?? '';
    $fileExists = (!empty($img) && file_exists(public_path($img))) ? "YES" : "NO";
    echo "ID {$d->id} | Type: {$type} | Name: {$trName} | Img: {$img} (Exists: {$fileExists})\n";
}
