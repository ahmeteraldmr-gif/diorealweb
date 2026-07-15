<?php

$dir = __DIR__ . '/app/Http/Controllers/Admin';
$files = ['RestaurantController.php', 'YachtController.php', 'DestinationController.php', 'EventController.php', 'JournalController.php', 'GuideController.php'];

$validationCode = <<<PHP
            'slug_tr' => 'nullable|string|max:255',
            'slug_en' => 'nullable|string|max:255',
            'seo_title_tr' => 'nullable|string|max:255',
            'seo_title_en' => 'nullable|string|max:255',
            'seo_description_tr' => 'nullable|string',
            'seo_description_en' => 'nullable|string',
            'og_image_file' => 'nullable|image|max:5120',
            'seo_noindex' => 'nullable',
PHP;

$assignmentCodeName = <<<PHP
        \$data['slug_tr'] = \$request->input('slug_tr') ? \Illuminate\Support\Str::slug(\$request->input('slug_tr')) : \Illuminate\Support\Str::slug(\$request->input('name.tr'));
        \$data['slug_en'] = \$request->input('slug_en') ? \Illuminate\Support\Str::slug(\$request->input('slug_en')) : \Illuminate\Support\Str::slug(\$request->input('name.en'));
        \$data['seo_title_tr'] = \$request->input('seo_title_tr');
        \$data['seo_title_en'] = \$request->input('seo_title_en');
        \$data['seo_description_tr'] = \$request->input('seo_description_tr');
        \$data['seo_description_en'] = \$request->input('seo_description_en');
        \$data['seo_noindex'] = \$request->has('seo_noindex') ? 1 : 0;
        if (\$request->hasFile('og_image_file')) {
            \$data['og_image'] = \$this->handleFileUpload(\$request->file('og_image_file'), 'uploads/seo');
        }
PHP;

$assignmentCodeTitle = <<<PHP
        \$data['slug_tr'] = \$request->input('slug_tr') ? \Illuminate\Support\Str::slug(\$request->input('slug_tr')) : \Illuminate\Support\Str::slug(\$request->input('title.tr'));
        \$data['slug_en'] = \$request->input('slug_en') ? \Illuminate\Support\Str::slug(\$request->input('slug_en')) : \Illuminate\Support\Str::slug(\$request->input('title.en'));
        \$data['seo_title_tr'] = \$request->input('seo_title_tr');
        \$data['seo_title_en'] = \$request->input('seo_title_en');
        \$data['seo_description_tr'] = \$request->input('seo_description_tr');
        \$data['seo_description_en'] = \$request->input('seo_description_en');
        \$data['seo_noindex'] = \$request->has('seo_noindex') ? 1 : 0;
        if (\$request->hasFile('og_image_file')) {
            \$data['og_image'] = \$this->handleFileUpload(\$request->file('og_image_file'), 'uploads/seo');
        }
PHP;

foreach ($files as $file) {
    $path = $dir . '/' . $file;
    if (!file_exists($path)) continue;

    $content = file_get_contents($path);

    // Determine field
    $isTitle = strpos($content, "'title.tr'") !== false;
    $assignment = $isTitle ? $assignmentCodeTitle : $assignmentCodeName;
    $field = $isTitle ? "title.tr" : "name.tr";

    // Replace validation in store
    $content = preg_replace("/('{$field}'\s*=>\s*'required[^']+',)/", $validationCode . "\n            $1", $content);

    // Replace assignment in store & update
    // We can inject it right before: // Handle cover image
    $content = preg_replace("/(\/\/\s*Handle cover image)/", $assignment . "\n\n        $1", $content);

    file_put_contents($path, $content);
    echo "Updated $file\n";
}

echo "Done.\n";
