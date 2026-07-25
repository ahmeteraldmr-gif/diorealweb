<?php

/**
 * Patch script to make all Admin Controllers robust, flexible, and fail-safe.
 */

$controllers = [
    'RestaurantController.php' => [
        'name_field' => 'name',
        'desc_field' => 'desc',
        'has_gallery' => true,
        'has_dest' => true,
        'type_title' => 'Lüks Restoran Deneyimi',
        'type_title_en' => 'Luxury Restaurant Experience',
    ],
    'JournalController.php' => [
        'name_field' => 'title',
        'desc_field' => 'desc',
        'has_gallery' => false,
        'has_dest' => true,
        'type_title' => 'Journal & Lüks Yaşam',
        'type_title_en' => 'Journal & Luxury Lifestyle',
    ],
    'EventController.php' => [
        'name_field' => 'title',
        'desc_field' => 'desc',
        'has_gallery' => false,
        'has_dest' => false,
        'type_title' => 'Özel Etkinlik & Deneyim',
        'type_title_en' => 'Exclusive Event & Experience',
    ],
    'GuideController.php' => [
        'name_field' => 'title',
        'desc_field' => 'desc',
        'has_gallery' => true,
        'has_dest' => false,
        'type_title' => 'Destinasyon Rehberi',
        'type_title_en' => 'Destination Guide',
    ],
    'YachtController.php' => [
        'name_field' => 'name',
        'desc_field' => 'desc',
        'has_gallery' => true,
        'has_dest' => false,
        'type_title' => 'Lüks Yat Kiralama & Deneyim',
        'type_title_en' => 'Luxury Yacht Charter',
    ],
    'DestinationController.php' => [
        'name_field' => 'name',
        'desc_field' => 'desc',
        'has_gallery' => true,
        'has_dest' => false,
        'type_title' => 'Seçkin Destinasyon',
        'type_title_en' => 'Exclusive Destination',
    ],
    'HotelController.php' => [
        'name_field' => 'name',
        'desc_field' => 'desc',
        'has_gallery' => true,
        'has_dest' => true,
        'type_title' => 'Lüks Otel Deneyimi',
        'type_title_en' => 'Luxury Hotel Experience',
    ],
];

echo "=== PATCHING ADMIN CONTROLLERS FOR SAFE UPLOADS & SEO AUTO-GEN ===\n";

// Let's create helper logic in controllers
foreach ($controllers as $filename => $config) {
    $filePath = __DIR__ . '/../app/Http/Controllers/Admin/' . $filename;
    if (!file_exists($filePath)) {
        echo "Skipping $filename (not found)\n";
        continue;
    }

    $content = file_get_contents($filePath);

    // Replace strict 'required|string|max:255' for .en fields with 'nullable|string|max:255'
    $content = str_replace("'name.en' => 'required|string|max:255'", "'name.en' => 'nullable|string|max:255'", $content);
    $content = str_replace("'title.en' => 'required|string|max:255'", "'title.en' => 'nullable|string|max:255'", $content);
    $content = str_replace("'month.en' => 'required|string|max:255'", "'month.en' => 'nullable|string|max:255'", $content);
    $content = str_replace("'loc.en' => 'required|string|max:255'", "'loc.en' => 'nullable|string|max:255'", $content);
    $content = str_replace("'desc.en' => 'required|string'", "'desc.en' => 'nullable|string'", $content);
    $content = str_replace("'region.en' => 'required|string|max:255'", "'region.en' => 'nullable|string|max:255'", $content);

    // Replace strict 'image' rule with 'file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200'
    $content = str_replace("'img_file' => 'nullable|image|max:51200'", "'img_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200'", $content);
    $content = str_replace("'gallery_files.*' => 'nullable|image|max:51200'", "'gallery_files.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:51200'", $content);
    $content = str_replace("'og_image_file' => 'nullable|image|max:5120'", "'og_image_file' => 'nullable|file|mimes:jpeg,jpg,png,gif,webp,avif,svg|max:10240'", $content);

    file_put_contents($filePath, $content);
    echo "✔ Patched $filename\n";
}

echo "Done patching controllers.\n";
