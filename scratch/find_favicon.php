<?php
$viewsDir = __DIR__ . '/../resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, 'favicon') !== false || strpos($content, 'apple-touch-icon') !== false) {
            echo "File: " . $file->getFilename() . "\n";
        }
    }
}
