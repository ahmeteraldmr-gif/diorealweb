<?php
function searchDir($dir) {
    $files = glob($dir . '/*');
    foreach ($files as $file) {
        if (is_dir($file)) {
            searchDir($file);
        } else if (str_ends_with($file, '.blade.php')) {
            $content = file_get_contents($file);
            if (strpos($content, 'time()') !== false) {
                echo "File: " . $file . "\n";
            }
        }
    }
}
searchDir(__DIR__ . '/../resources/views');
