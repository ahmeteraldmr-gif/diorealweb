<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$guides = App\Models\Guide::all();
echo "Total guides in DB: " . $guides->count() . "\n";
foreach ($guides as $g) {
    echo "ID: {$g->id} | Title: " . json_encode($g->title) . " | Tag/Region: " . json_encode($g->tag) . " | Desc length TR: " . strlen($g->desc['tr'] ?? '') . " | Desc length EN: " . strlen($g->desc['en'] ?? '') . "\n";
}
