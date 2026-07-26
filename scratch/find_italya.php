<?php
$dir = __DIR__ . '/..';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($iterator as $file) {
    if ($file->isFile() && in_array($file->getExtension(), ['php', 'json', 'blade'])) {
        $path = $file->getPathname();
        if (strpos($path, 'vendor') !== false || strpos($path, '.git') !== false || strpos($path, 'node_modules') !== false) {
            continue;
        }
        $content = file_get_contents($path);
        if (mb_stripos($content, 'talya') !== false) {
            echo "Found in: " . $file->getFilename() . " ($path)\n";
        }
    }
}
