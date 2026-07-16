<?php

$files = [
    __DIR__ . '/resources/views/restoran-detay.blade.php' => 'restoran',
    __DIR__ . '/resources/views/otel-detay.blade.php' => 'otel'
];

foreach ($files as $file => $var) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);

    // Replace TR
    $content = preg_replace(
        "/<div class=\"sidebar-info-value lang-text-tr\">\{\{\s*\\\${$var}->tag\['tr'\]\s*\?\?\s*''\s*\}\}<\/div>/",
        "<div class=\"sidebar-info-value lang-text-tr\">{{ \${$var}->location['tr'] ?? (\${$var}->destination->name['tr'] ?? (\${$var}->tag['tr'] ?? '')) }}</div>",
        $content
    );

    // Replace EN
    $content = preg_replace(
        "/<div class=\"sidebar-info-value lang-text-en\">\{\{\s*\\\${$var}->tag\['en'\]\s*\?\?\s*''\s*\}\}<\/div>/",
        "<div class=\"sidebar-info-value lang-text-en\">{{ \${$var}->location['en'] ?? (\${$var}->destination->name['en'] ?? (\${$var}->tag['en'] ?? '')) }}</div>",
        $content
    );

    file_put_contents($file, $content);
    echo "Patched frontend blade: " . basename($file) . "\n";
}
