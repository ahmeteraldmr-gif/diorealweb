<?php
$viewsDir = __DIR__ . '/../resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

$faviconTags = '    <!-- Favicon & Touch Icons -->
    <link rel="icon" type="image/png" href="{{ asset(\'foto.img/logo_dioreal.png\') }}">
    <link rel="apple-touch-icon" href="{{ asset(\'foto.img/logo_dioreal.png\') }}">';

$count = 0;
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $filePath = $file->getPathname();
        $content = file_get_contents($filePath);
        
        if (strpos($content, '<head>') !== false && strpos($content, 'foto.img/logo_dioreal.png') === false && strpos($content, 'favicon') === false) {
            $updated = str_replace('<head>', "<head>\n" . $faviconTags, $content);
            file_put_contents($filePath, $updated);
            echo "✔ Added favicon to: " . $file->getFilename() . "\n";
            $count++;
        }
    }
}

echo "Total files updated: $count\n";
