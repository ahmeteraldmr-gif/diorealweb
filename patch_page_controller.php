<?php

$file = __DIR__ . '/app/Http/Controllers/PageController.php';
$content = file_get_contents($file);

// Replace method signatures
$content = preg_replace('/public function (\w+Detay)\(\$id\)/', 'public function $1($slug_or_id)', $content);

// Replace findOrFail for Hotel
$content = preg_replace('/Hotel::findOrFail\(\$id\)/', 'Hotel::where(\'id\', $slug_or_id)->orWhere(\'slug_tr\', $slug_or_id)->orWhere(\'slug_en\', $slug_or_id)->firstOrFail()', $content);

// Replace findOrFail for Restaurant
$content = preg_replace('/Restaurant::findOrFail\(\$id\)/', 'Restaurant::where(\'id\', $slug_or_id)->orWhere(\'slug_tr\', $slug_or_id)->orWhere(\'slug_en\', $slug_or_id)->firstOrFail()', $content);

// Replace findOrFail for Journal
$content = preg_replace('/\\\App\\\Models\\\Journal::findOrFail\(\$id\)/', '\\\App\\\Models\\\Journal::where(\'id\', $slug_or_id)->orWhere(\'slug_tr\', $slug_or_id)->orWhere(\'slug_en\', $slug_or_id)->firstOrFail()', $content);
$content = preg_replace('/\'!=\', \$id/', '\'!=\', $journal->id', $content);

// Replace findOrFail for Destination
$content = preg_replace('/\\\App\\\Models\\\Destination::findOrFail\(\$id\)/', '\\\App\\\Models\\\Destination::where(\'id\', $slug_or_id)->orWhere(\'slug_tr\', $slug_or_id)->orWhere(\'slug_en\', $slug_or_id)->firstOrFail()', $content);
$content = preg_replace('/\'destination_id\', \$id/', '\'destination_id\', $destination->id', $content);

// Replace findOrFail for Event
$content = preg_replace('/\\\App\\\Models\\\Event::findOrFail\(\$id\)/', '\\\App\\\Models\\\Event::where(\'id\', $slug_or_id)->orWhere(\'slug_tr\', $slug_or_id)->orWhere(\'slug_en\', $slug_or_id)->firstOrFail()', $content);

// Replace findOrFail for Guide
$content = preg_replace('/\\\App\\\Models\\\Guide::findOrFail\(\$id\)/', '\\\App\\\Models\\\Guide::where(\'id\', $slug_or_id)->orWhere(\'slug_tr\', $slug_or_id)->orWhere(\'slug_en\', $slug_or_id)->firstOrFail()', $content);

// Replace findOrFail for Yacht
$content = preg_replace('/\\\App\\\Models\\\Yacht::findOrFail\(\$id\)/', '\\\App\\\Models\\\Yacht::where(\'id\', $slug_or_id)->orWhere(\'slug_tr\', $slug_or_id)->orWhere(\'slug_en\', $slug_or_id)->firstOrFail()', $content);

file_put_contents($file, $content);
echo "PageController patched.\n";
