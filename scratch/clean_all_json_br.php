<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

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

$dataDir = storage_path('app/data');
$files = glob($dataDir . '/*.json');

foreach ($files as $filePath) {
    $filename = basename($filePath);
    $data = json_decode(file_get_contents($filePath), true);
    if (!is_array($data)) continue;

    foreach ($data as &$item) {
        foreach (['desc', 'long_desc', 'content', 'title', 'name', 'tag', 'region'] as $field) {
            if (isset($item[$field])) {
                $item[$field] = cleanBrText($item[$field]);
            }
        }
    }

    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Cleaned BR tags in {$filename}\n";
}

echo "\n=== ALL JSON FILES CLEANED ===\n";
