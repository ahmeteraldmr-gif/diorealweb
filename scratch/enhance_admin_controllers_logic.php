<?php

/**
 * Script to add fallback and SEO auto-generation to all 7 Admin controllers
 */

$controllerFiles = [
    'HotelController.php' => ['name', 'tag', 'location', 'desc', 'long_desc'],
    'RestaurantController.php' => ['name', 'tag', 'location', 'desc', 'long_desc'],
    'YachtController.php' => ['name', 'tag', 'desc', 'long_desc'],
    'EventController.php' => ['title', 'tag', 'month', 'loc', 'desc', 'long_desc'],
    'GuideController.php' => ['title', 'tag', 'desc'],
    'JournalController.php' => ['title', 'tag', 'desc', 'content'],
    'DestinationController.php' => ['name', 'region', 'desc'],
];

foreach ($controllerFiles as $filename => $fields) {
    $filePath = __DIR__ . '/../app/Http/Controllers/Admin/' . $filename;
    if (!file_exists($filePath)) continue;

    $code = file_get_contents($filePath);

    // Primary name field for model
    $mainNameField = in_array('name', $fields) ? 'name' : 'title';

    // Build fallback block
    $fallbackLines = [];
    foreach ($fields as $field) {
        $fallbackLines[] = "        \${$field} = \$request->input('{$field}', []);";
        $fallbackLines[] = "        if (is_array(\${$field})) {";
        $fallbackLines[] = "            if (empty(\${$field}['en']) && !empty(\${$field}['tr'])) { \${$field}['en'] = \${$field}['tr']; }";
        $fallbackLines[] = "            \$data['{$field}'] = \${$field};";
        $fallbackLines[] = "        }";
    }

    $fallbackBlock = implode("\n", $fallbackLines);

    // Build SEO auto gen block
    $seoBlock = "
        // Auto-fallback EN fields if empty
{$fallbackBlock}

        \$trMainName = \$data['{$mainNameField}']['tr'] ?? (\$request->input('{$mainNameField}.tr') ?? '');
        \$enMainName = \$data['{$mainNameField}']['en'] ?? (\$request->input('{$mainNameField}.en') ?? \$trMainName);
        \$trDesc = \$data['desc']['tr'] ?? (\$request->input('desc.tr') ?? '');
        \$enDesc = \$data['desc']['en'] ?? (\$request->input('desc.en') ?? \$trDesc);

        \$data['slug_tr'] = \$request->filled('slug_tr') ? \Illuminate\Support\Str::slug(\$request->input('slug_tr')) : \Illuminate\Support\Str::slug(\$trMainName);
        \$data['slug_en'] = \$request->filled('slug_en') ? \Illuminate\Support\Str::slug(\$request->input('slug_en')) : \Illuminate\Support\Str::slug(\$enMainName);

        \$data['seo_title_tr'] = \$request->filled('seo_title_tr') ? \$request->input('seo_title_tr') : (\$trMainName . ' | Dioreal Dijital Lüks Yaşam Platformu');
        \$data['seo_title_en'] = \$request->filled('seo_title_en') ? \$request->input('seo_title_en') : (\$enMainName . ' | Dioreal Digital Luxury Platform');

        \$data['seo_description_tr'] = \$request->filled('seo_description_tr') ? \$request->input('seo_description_tr') : \Illuminate\Support\Str::limit(strip_tags(\$trDesc), 155);
        \$data['seo_description_en'] = \$request->filled('seo_description_en') ? \$request->input('seo_description_en') : \Illuminate\Support\Str::limit(strip_tags(\$enDesc), 155);
";

    // Insert into store() and update()
    // Find where $data['slug_tr'] = ... is set and replace that block with our comprehensive $seoBlock
    $pattern = '/\$data\[\'slug_tr\'\] = .*?\$data\[\'seo_noindex\'\] = .*?;/s';
    
    if (preg_match($pattern, $code)) {
        $code = preg_replace($pattern, $seoBlock . "\n        \$data['seo_noindex'] = \$request->has('seo_noindex') ? 1 : 0;", $code);
        file_put_contents($filePath, $code);
        echo "✔ Enhanced SEO & fallback logic in $filename\n";
    } else {
        echo "⚠ Could not match pattern in $filename\n";
    }
}

echo "Done.\n";
