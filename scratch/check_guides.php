<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Guide;

$guides = Guide::all();
echo "Total Guides: " . count($guides) . "\n";
foreach ($guides as $g) {
    $trTitle = is_array($g->title) ? ($g->title['tr'] ?? '') : $g->title;
    $img = $g->img ?? '';
    $fileExists = (!empty($img) && file_exists(public_path($img))) ? "YES" : "NO";
    echo "ID {$g->id} | Title: {$trTitle} | Img: {$img} (Exists: {$fileExists})\n";
}
