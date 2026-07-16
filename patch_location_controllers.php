<?php

$files = [
    __DIR__ . '/app/Http/Controllers/Admin/RestaurantController.php',
    __DIR__ . '/app/Http/Controllers/Admin/HotelController.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);

    // 1. Add validation rules
    $content = preg_replace("/('tag\.tr'\s*=>\s*'nullable\|string\|max:255',)/", "$1\n            'location.tr' => 'nullable|string|max:255',\n            'location.en' => 'nullable|string|max:255',", $content);

    // 2. Add 'location' to only([])
    $content = preg_replace("/\-\>only\(\[\s*'name',\s*'tag',/", "->only(['name', 'tag', 'location',", $content);

    file_put_contents($file, $content);
    echo "Patched " . basename($file) . "\n";
}
