<?php
function searchAndFix($dir) {
    $files = glob($dir . '/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_dir($file)) {
            $count += searchAndFix($file);
        } else if (str_ends_with($file, '.blade.php')) {
            $content = file_get_contents($file);
            if (strpos($content, '?v={{ time() }}') !== false || strpos($content, '?v={{time()}}') !== false) {
                $newContent = str_replace(['?v={{ time() }}', '?v={{time()}}', '?v={{ time() }}'], '?v=2.5.0', $content);
                file_put_contents($file, $newContent);
                echo "Fixed: " . basename($file) . "\n";
                $count++;
            }
        }
    }
    return $count;
}
$total = searchAndFix(__DIR__ . '/../resources/views');
echo "Total files fixed: " . $total . "\n";
