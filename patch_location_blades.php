<?php

$files = [
    __DIR__ . '/resources/views/admin/restaurants/create.blade.php' => 'old(\'location.tr\')',
    __DIR__ . '/resources/views/admin/restaurants/edit.blade.php' => 'old(\'location.tr\', $restaurant->location[\'tr\'] ?? \'\')',
    __DIR__ . '/resources/views/admin/hotels/create.blade.php' => 'old(\'location.tr\')',
    __DIR__ . '/resources/views/admin/hotels/edit.blade.php' => 'old(\'location.tr\', $hotel->location[\'tr\'] ?? \'\')',
];

$filesEn = [
    __DIR__ . '/resources/views/admin/restaurants/create.blade.php' => 'old(\'location.en\')',
    __DIR__ . '/resources/views/admin/restaurants/edit.blade.php' => 'old(\'location.en\', $restaurant->location[\'en\'] ?? \'\')',
    __DIR__ . '/resources/views/admin/hotels/create.blade.php' => 'old(\'location.en\')',
    __DIR__ . '/resources/views/admin/hotels/edit.blade.php' => 'old(\'location.en\', $hotel->location[\'en\'] ?? \'\')',
];

foreach ($files as $file => $valTr) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);

    $valEn = $filesEn[$file];

    $htmlTr = <<<HTML
                <div class="form-group">
                    <label class="form-label" for="location_tr">Konum (TR)</label>
                    <input type="text" name="location[tr]" id="location_tr" class="form-control" placeholder="Örn: Yalıkavak, Bodrum" value="{{ {$valTr} }}">
                </div>
HTML;

    $htmlEn = <<<HTML
                <div class="form-group">
                    <label class="form-label" for="location_en">Location (EN)</label>
                    <input type="text" name="location[en]" id="location_en" class="form-control" placeholder="e.g. Yalikavak, Bodrum" value="{{ {$valEn} }}">
                </div>
HTML;

    // insert Tr right after tag.tr group
    $content = preg_replace('/(<label class="form-label" for="tag_tr">.*?<\/div>)/s', "$1\n                \n$htmlTr", $content, 1);
    
    // insert En right after tag.en group
    $content = preg_replace('/(<label class="form-label" for="tag_en">.*?<\/div>)/s', "$1\n                \n$htmlEn", $content, 1);

    file_put_contents($file, $content);
    echo "Patched blade: " . basename($file) . "\n";
}
