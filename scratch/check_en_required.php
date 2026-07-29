<?php
function checkEnRequired($dir) {
    $files = glob($dir . '/*');
    foreach ($files as $file) {
        if (is_dir($file)) {
            checkEnRequired($file);
        } else if (str_ends_with($file, '.blade.php')) {
            $content = file_get_contents($file);
            if (preg_match_all('/name="[^"]*\[en\]"[^>]*required/i', $content, $matches)) {
                echo "Found required on [en] in: " . basename($file) . "\n";
            }
        }
    }
}
checkEnRequired(__DIR__ . '/../resources/views/admin');
