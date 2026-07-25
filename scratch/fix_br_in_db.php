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
use Illuminate\Support\Facades\DB;

function cleanBrText($text) {
    if (is_array($text)) {
        foreach ($text as $k => $v) {
            $text[$k] = cleanBrText($v);
        }
        return $text;
    }
    if (!is_string($text)) return $text;

    // Convert all variations of <br> to newlines
    $cleaned = preg_replace('/<br\s*\/?>/i', "\n", $text);
    // Decode HTML entities
    $cleaned = html_entity_decode($cleaned, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    // Normalize multiple newlines
    $cleaned = preg_replace("/\n{3,}/", "\n\n", $cleaned);
    return trim($cleaned);
}

function processModule($jsonFileName, $tableName, $fieldsToClean) {
    $filePath = storage_path("app/data/{$jsonFileName}");
    if (!file_exists($filePath)) return;

    $data = json_decode(file_get_contents($filePath), true);
    foreach ($data as &$item) {
        foreach ($fieldsToClean as $field) {
            if (isset($item[$field])) {
                $item[$field] = cleanBrText($item[$field]);
            }
        }
    }
    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    DB::table($tableName)->delete();
    foreach ($data as $item) {
        // Encode array fields to JSON for DB insertion
        $dbData = [];
        foreach ($item as $k => $v) {
            $dbData[$k] = is_array($v) ? json_encode($v, JSON_UNESCAPED_UNICODE) : $v;
        }
        DB::table($tableName)->insert($dbData);
    }
    echo "Cleaned <br> and HTML entities from {$tableName}!\n";
}

processModule('dioreal_destinations_data.json', 'destinations', ['desc', 'name', 'region']);
processModule('dioreal_journal_data.json', 'journals', ['desc', 'content', 'title', 'tag']);
processModule('dioreal_hotels_data.json', 'hotels', ['desc', 'long_desc', 'name', 'tag']);
processModule('dioreal_restaurants_data.json', 'restaurants', ['desc', 'long_desc', 'name', 'tag']);
processModule('dioreal_yachts_data.json', 'yachts', ['desc', 'long_desc', 'name', 'tag']);
processModule('dioreal_guide_data.json', 'guides', ['desc', 'title', 'tag']);
processModule('dioreal_events_data.json', 'events', ['desc', 'long_desc', 'title', 'tag']);

echo "\n=== ALL BR TAGS CLEANED & DECODED SUCCESSFULLY ===\n";
