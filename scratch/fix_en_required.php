<?php
function removeEnRequired($dir) {
    $files = glob($dir . '/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_dir($file)) {
            $count += removeEnRequired($file);
        } else if (str_ends_with($file, '.blade.php')) {
            $content = file_get_contents($file);
            // Remove required attribute from input/textarea containing [en] in name
            $newContent = preg_replace('/(name="[^"]*\[en\]"[^>]*?)\s+required/i', '$1', $content);
            $newContent = preg_replace('/(required[^>]*?name="[^"]*\[en\]")/i', str_replace('required', '', '$0'), $newContent);
            if ($newContent !== $content) {
                file_put_contents($file, $newContent);
                echo "Removed required on [en] in: " . $file . "\n";
                $count++;
            }
        }
    }
    return $count;
}
$fixed = removeEnRequired(__DIR__ . '/../resources/views/admin');
echo "Total admin files cleaned: " . $fixed . "\n";
