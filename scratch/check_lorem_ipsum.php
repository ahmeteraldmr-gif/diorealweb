<?php
$dir = __DIR__ . '/..';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$loremCount = 0;
foreach ($iterator as $file) {
    if ($file->isFile() && in_array($file->getExtension(), ['php', 'json', 'blade'])) {
        $path = $file->getPathname();
        if (strpos($path, 'vendor') !== false || strpos($path, '.git') !== false || strpos($path, 'node_modules') !== false) {
            continue;
        }
        $content = file_get_contents($path);
        if (stripos($content, 'lorem') !== false || stripos($content, 'ipsum') !== false) {
            echo "Found in: " . $file->getFilename() . " ($path)\n";
            $loremCount++;
        }
    }
}

echo "Total files with Lorem Ipsum: $loremCount\n";
