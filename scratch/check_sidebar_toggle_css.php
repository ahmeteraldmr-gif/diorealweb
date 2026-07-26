<?php
$css = file_get_contents(__DIR__ . '/../public/css/admin-new.css');
$lines = explode("\n", $css);
foreach ($lines as $i => $line) {
    if (strpos($line, 'sidebar-toggle') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
