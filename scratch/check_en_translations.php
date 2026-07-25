<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;

echo "=== CHECKING ENGLISH TRANSLATIONS ACROSS ALL MODULES ===\n\n";

$modules = [
    'destinations' => Destination::all(),
    'journals' => Journal::all(),
    'hotels' => Hotel::all(),
    'restaurants' => Restaurant::all(),
    'yachts' => Yacht::all(),
    'guides' => Guide::all(),
    'events' => Event::all(),
];

foreach ($modules as $modName => $items) {
    echo "Module: {$modName} (" . count($items) . " items)\n";
    foreach ($items as $item) {
        $tr = is_array($item->desc ?? null) ? ($item->desc['tr'] ?? '') : (string)($item->desc ?? '');
        $en = is_array($item->desc ?? null) ? ($item->desc['en'] ?? '') : (string)($item->desc ?? '');

        // Check if EN is identical to TR or empty
        $isSame = (trim($tr) === trim($en) && strlen($tr) > 20);
        $isEmpty = empty(trim($en));

        if ($isSame || $isEmpty) {
            $title = is_array($item->name ?? $item->title ?? null) ? ($item->name['tr'] ?? $item->title['tr'] ?? $item->id) : ($item->name ?? $item->title ?? $item->id);
            echo "   ⚠️ ID {$item->id} ({$title}): EN description is " . ($isSame ? "IDENTICAL TO TURKISH!" : "EMPTY!") . "\n";
        }
    }
}
