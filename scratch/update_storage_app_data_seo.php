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
use Illuminate\Support\Str;

echo "=== POPULATING & UPDATING STORAGE/APP/DATA/*.JSON WITH RICH SEO METADATA ===\n\n";

$dataDir = storage_path('app/data');

$models = [
    'dioreal_hotels_data.json' => Hotel::class,
    'dioreal_restaurants_data.json' => Restaurant::class,
    'dioreal_yachts_data.json' => Yacht::class,
    'dioreal_destinations_data.json' => Destination::class,
    'dioreal_events_data.json' => Event::class,
    'dioreal_guide_data.json' => Guide::class,
    'dioreal_journal_data.json' => Journal::class,
];

foreach ($models as $filename => $modelClass) {
    $path = $dataDir . '/' . $filename;
    if (!file_exists($path)) continue;

    $items = json_decode(file_get_contents($path), true);
    if (!is_array($items)) continue;

    $updated = 0;
    foreach ($items as &$item) {
        $trName = is_array($item['name'] ?? null) ? ($item['name']['tr'] ?? '') : ($item['name'] ?? '');
        $enName = is_array($item['name'] ?? null) ? ($item['name']['en'] ?? $trName) : ($item['name'] ?? '');
        if (!$trName) {
            $trName = is_array($item['title'] ?? null) ? ($item['title']['tr'] ?? '') : ($item['title'] ?? '');
            $enName = is_array($item['title'] ?? null) ? ($item['title']['en'] ?? $trName) : ($item['title'] ?? '');
        }

        $trDesc = is_array($item['desc'] ?? null) ? ($item['desc']['tr'] ?? '') : ($item['desc'] ?? '');
        $enDesc = is_array($item['desc'] ?? null) ? ($item['desc']['en'] ?? $trDesc) : ($item['desc'] ?? '');

        $trLoc = is_array($item['location'] ?? null) ? ($item['location']['tr'] ?? '') : ($item['location'] ?? '');
        if (!$trLoc) {
            $trLoc = is_array($item['loc'] ?? null) ? ($item['loc']['tr'] ?? '') : ($item['loc'] ?? '');
        }
        if (!$trLoc && isset($item['region'])) {
            $trLoc = is_array($item['region']) ? ($item['region']['tr'] ?? '') : $item['region'];
        }

        // Slugs
        if (empty($item['slug_tr'])) {
            $item['slug_tr'] = Str::slug($trName);
        }
        if (empty($item['slug_en'])) {
            $item['slug_en'] = Str::slug($enName);
        }

        // SEO Titles
        if (empty($item['seo_title_tr'])) {
            $item['seo_title_tr'] = $trName . ($trLoc ? ' - ' . $trLoc : '') . ' | Dioreal Dijital Lüks Yaşam Platformu';
        }
        if (empty($item['seo_title_en'])) {
            $item['seo_title_en'] = $enName . ($trLoc ? ' - ' . $trLoc : '') . ' | Dioreal Digital Luxury Platform';
        }

        // SEO Descriptions
        if (empty($item['seo_description_tr'])) {
            $item['seo_description_tr'] = Str::limit(strip_tags($trDesc), 155);
        }
        if (empty($item['seo_description_en'])) {
            $item['seo_description_en'] = Str::limit(strip_tags($enDesc), 155);
        }

        $item['seo_noindex'] = $item['seo_noindex'] ?? 0;

        // Also update Database Model if exists
        if (isset($item['id'])) {
            $modelClass::where('id', $item['id'])->update([
                'slug_tr' => $item['slug_tr'],
                'slug_en' => $item['slug_en'],
                'seo_title_tr' => $item['seo_title_tr'],
                'seo_title_en' => $item['seo_title_en'],
                'seo_description_tr' => $item['seo_description_tr'],
                'seo_description_en' => $item['seo_description_en'],
                'seo_noindex' => $item['seo_noindex'],
            ]);
        }
        $updated++;
    }

    file_put_contents($path, json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "✔ Updated {$filename} ($updated items)\n";
}

echo "\nDone updating JSON seed files & database.\n";
