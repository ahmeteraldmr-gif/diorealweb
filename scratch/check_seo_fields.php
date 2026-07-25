<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Journal;

$models = [
    'Hotel' => Hotel::all(),
    'Restaurant' => Restaurant::all(),
    'Yacht' => Yacht::all(),
    'Destination' => Destination::all(),
    'Event' => Event::all(),
    'Guide' => Guide::all(),
    'Journal' => Journal::all(),
];

foreach ($models as $name => $items) {
    echo "=== $name (" . count($items) . " records) ===\n";
    foreach ($items as $item) {
        $trTitle = $item->getTranslation('name', 'tr') ?? $item->getTranslation('title', 'tr') ?? $item->name ?? $item->title;
        echo "ID {$item->id}: {$trTitle}\n";
        echo "  SEO Title TR: " . ($item->seo_title_tr ?: 'EMPTY') . "\n";
        echo "  SEO Desc TR: " . ($item->seo_description_tr ?: 'EMPTY') . "\n";
    }
}
