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

$mappings = [
    'dioreal_hotels_data.json' => Hotel::all(),
    'dioreal_restaurants_data.json' => Restaurant::all(),
    'dioreal_yachts_data.json' => Yacht::all(),
    'dioreal_destinations_data.json' => Destination::all(),
    'dioreal_events_data.json' => Event::all(),
    'dioreal_guide_data.json' => Guide::all(),
    'dioreal_journal_data.json' => Journal::all(),
];

foreach ($mappings as $filename => $models) {
    $path = storage_path("app/{$filename}");
    $data = [];
    foreach ($models as $m) {
        $arr = $m->toArray();
        $data[] = $arr;
    }
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "✔ Exported " . count($data) . " items to {$filename}\n";
}

echo "Done dumping updated JSON seeders.\n";
