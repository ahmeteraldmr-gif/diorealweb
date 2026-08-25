<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Clean DB
$guide = App\Models\Guide::find(4);
if ($guide) {
    $title = $guide->title;
    if (isset($title['en'])) {
        $title['en'] = str_replace('🇹🇷 ', '', $title['en']);
        $title['en'] = str_replace('🇹🇷', '', $title['en']);
        $title['en'] = trim($title['en']);
    }
    $guide->title = $title;
    if ($guide->seo_title_en) {
        $guide->seo_title_en = str_replace('🇹🇷 ', '', $guide->seo_title_en);
        $guide->seo_title_en = str_replace('🇹🇷', '', $guide->seo_title_en);
    }
    $guide->save();
    echo "DB Guide ID 4 updated cleanly: " . json_encode($guide->title) . "\n";
}

// 2. Clean JSON files
$jsonFiles = [
    __DIR__ . '/../storage/app/data/dioreal_guide_data.json',
    __DIR__ . '/../storage/app/dioreal_guide_data.json',
];

foreach ($jsonFiles as $f) {
    if (file_exists($f)) {
        $content = file_get_contents($f);
        $content = str_replace('🇹🇷 ', '', $content);
        $content = str_replace('🇹🇷', '', $content);
        file_put_contents($f, $content);
        echo "Cleaned JSON file: " . basename($f) . "\n";
    }
}
