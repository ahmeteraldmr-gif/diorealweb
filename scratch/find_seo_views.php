<?php
$viewsDir = __DIR__ . '/../resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, 'seo_') !== false || strpos($content, 'meta name="description"') !== false) {
            echo "File: " . $file->getFilename() . "\n";
            preg_match_all('/<title>.*<\/title>|<meta name="description".*>/i', $content, $matches);
            foreach ($matches[0] as $match) {
                echo "  " . trim($match) . "\n";
            }
        }
    }
}
