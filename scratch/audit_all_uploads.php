<?php
$controllers = glob(__DIR__ . '/../app/Http/Controllers/Admin/*.php');
foreach ($controllers as $file) {
    $content = file_get_contents($file);
    echo "=== " . basename($file) . " ===\n";
    preg_match_all('/(move|store|makeDirectory|public_path|storage_path|tmp)/i', $content, $matches, PREG_OFFSET_CAPTURE);
    foreach ($matches[0] as $m) {
        $start = max(0, $m[1] - 40);
        $snippet = substr($content, $start, 120);
        echo "   Snippet: " . str_replace("\n", " ", $snippet) . "\n";
    }
}
