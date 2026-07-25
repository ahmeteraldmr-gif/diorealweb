<?php
/**
 * Add responsive.css link to all Blade views that don't have it yet
 */

$viewsDir = __DIR__ . '/../resources/views';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

$responsiveLine = '    <link rel="stylesheet" href="{{ asset(\'css/responsive.css\') }}?v={{ time() }}">';

$fixed = 0;
$skipped = 0;

foreach ($iterator as $file) {
    if (!$file->isFile() || $file->getExtension() !== 'php') continue;
    
    $content = file_get_contents($file->getPathname());
    
    // Skip if already has responsive.css
    if (strpos($content, 'responsive.css') !== false) {
        $skipped++;
        continue;
    }
    
    // Skip if no </head> tag (not a proper HTML page)
    if (strpos($content, '</head>') === false && strpos($content, 'asset(\'css/') === false) {
        $skipped++;
        continue;
    }
    
    // Insert before </head>
    if (strpos($content, '</head>') !== false) {
        $newContent = str_replace('</head>', $responsiveLine . "\n</head>", $content);
        file_put_contents($file->getPathname(), $newContent);
        echo "✔ Added responsive.css to " . $file->getFilename() . "\n";
        $fixed++;
    }
}

echo "\n=== DONE: Fixed $fixed files, Skipped $skipped files ===\n";
