<?php
$faviconTags = <<<'HTML'
    <!-- Favicon & Touch Icons for Google Search & Browsers -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
HTML;

function updateFavicons($dir, $faviconTags) {
    $files = glob($dir . '/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_dir($file)) {
            $count += updateFavicons($file, $faviconTags);
        } else if (str_ends_with($file, '.blade.php')) {
            $content = file_get_contents($file);
            if (strpos($content, 'rel="icon"') !== false || strpos($content, 'rel="apple-touch-icon"') !== false) {
                // Remove old icon/apple-touch-icon lines
                $newContent = preg_replace('/<!-- Favicon & Touch Icons -->\s*/i', '', $content);
                $newContent = preg_replace('/<link rel="(icon|apple-touch-icon)"[^>]*>\s*/i', '', $newContent);
                
                // Insert new favicon tags right after <head>
                if (strpos($newContent, '<head>') !== false) {
                    $newContent = str_replace('<head>', "<head>\n" . $faviconTags, $newContent);
                } else {
                    $newContent = $faviconTags . "\n" . $newContent;
                }
                
                if ($newContent !== $content) {
                    file_put_contents($file, $newContent);
                    echo "Updated favicons in: " . basename($file) . "\n";
                    $count++;
                }
            }
        }
    }
    return $count;
}

$updatedCount = updateFavicons(__DIR__ . '/../resources/views', $faviconTags);
echo "Total view files updated: {$updatedCount}\n";
