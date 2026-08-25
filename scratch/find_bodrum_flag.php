<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== SEARCHING FOR FLAG EMOJI IN DB ===\n";

$guides = App\Models\Guide::all();
foreach ($guides as $g) {
    $titleStr = json_encode($g->title, JSON_UNESCAPED_UNICODE);
    if (mb_strpos($titleStr, '🇹🇷') !== false || strpos($titleStr, '\ud83c\uddf9') !== false || mb_strpos($titleStr, 'Bodrum') !== false) {
        echo "Guide ID {$g->id}: title = " . json_encode($g->title, JSON_UNESCAPED_UNICODE) . "\n";
    }
}

$destinations = App\Models\Destination::all();
foreach ($destinations as $d) {
    $nameStr = json_encode($d->name, JSON_UNESCAPED_UNICODE);
    if (mb_strpos($nameStr, '🇹🇷') !== false || strpos($nameStr, '\ud83c\uddf9') !== false) {
        echo "Destination ID {$d->id}: name = " . json_encode($d->name, JSON_UNESCAPED_UNICODE) . "\n";
    }
}
