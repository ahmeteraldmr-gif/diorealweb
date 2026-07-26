<?php
$viewsDir = __DIR__ . '/../resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, 'file_exists') !== false) {
            echo "File: " . $file->getFilename() . "\n";
            preg_match_all('/file_exists\([^\)]+\)/', $content, $matches);
            foreach ($matches[0] as $m) {
                echo "  $m\n";
            }
        }
    }
}
