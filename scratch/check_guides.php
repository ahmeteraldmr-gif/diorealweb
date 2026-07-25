<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Guide;

$guides = Guide::all();
echo "Guide count: " . count($guides) . "\n\n";

foreach ($guides as $g) {
    echo "ID: {$g->id}\n";
    echo "  Title TR: " . ($g->title['tr'] ?? 'NULL') . "\n";
    echo "  Title EN: " . ($g->title['en'] ?? 'NULL') . "\n";
    echo "  Desc TR: " . ($g->desc['tr'] ?? 'NULL') . "\n";
    echo "  Desc EN: " . ($g->desc['en'] ?? 'NULL') . "\n";
    echo "  Img: " . ($g->img ?? 'NULL') . "\n";
    echo "---------------------------\n";
}
