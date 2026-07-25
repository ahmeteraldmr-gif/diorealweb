<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;

$fethiye = Destination::find(3);
echo "Fethiye ID 3 Name: " . ($fethiye->name['tr'] ?? '') . "\n";
echo "Fethiye Desc Length: " . strlen($fethiye->desc['tr'] ?? '') . " chars\n";
echo "First 200 chars:\n" . substr($fethiye->desc['tr'] ?? '', 0, 200) . "...\n";
