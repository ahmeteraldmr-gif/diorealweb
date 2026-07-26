<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Event;
use App\Models\Journal;

$models = [
    'Destination' => Destination::class,
    'Guide' => Guide::class,
    'Hotel' => Hotel::class,
    'Restaurant' => Restaurant::class,
    'Yacht' => Yacht::class,
    'Event' => Event::class,
    'Journal' => Journal::class,
];

foreach ($models as $name => $class) {
    $items = $class::all();
    foreach ($items as $item) {
        $trName = is_array($item->name ?? ($item->title ?? '')) ? ($item->name['tr'] ?? ($item->title['tr'] ?? '')) : ($item->name ?? ($item->title ?? ''));
        $img = $item->img ?? '';
        if (empty($img) || !file_exists(public_path($img))) {
            echo "[$name ID {$item->id}] Name: '$trName' | Img: '$img'\n";
        }
    }
}
