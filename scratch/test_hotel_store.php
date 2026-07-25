<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Hotel;

try {
    $hotel = Hotel::create([
        'name' => ['tr' => 'Test Hotel', 'en' => 'Test Hotel EN'],
        'tag' => ['tr' => 'Lüks', 'en' => 'Luxury'],
        'location' => ['tr' => 'Bodrum', 'en' => 'Bodrum'],
        'desc' => ['tr' => 'Test açıklama', 'en' => 'Test description'],
        'long_desc' => ['tr' => 'Detay', 'en' => 'Detail'],
        'slug_tr' => 'test-hotel-' . time(),
        'slug_en' => 'test-hotel-en-' . time(),
        'seo_title_tr' => 'Test Hotel SEO',
        'seo_title_en' => 'Test Hotel SEO EN',
        'seo_description_tr' => 'Test SEO Desc',
        'seo_description_en' => 'Test SEO Desc EN',
        'img' => 'foto.img/otel_aman.jpg',
        'gallery' => [],
        'order' => 0,
        'is_archived' => 0,
    ]);

    echo "✔ Successfully created hotel ID: " . $hotel->id . "\n";
    $hotel->delete();
    echo "✔ Cleaned up test hotel.\n";
} catch (\Throwable $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
