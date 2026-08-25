<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$settings = App\Models\Setting::all();
foreach ($settings as $s) {
    if ($s->key === 'seo_title_home_tr' || $s->key === 'seo_title_tr') {
        $s->value = 'DIOREAL — Seyahat, Destinasyonlar ve Yaşam Kültürü';
        $s->save();
        echo "Updated {$s->key}\n";
    }
    if ($s->key === 'seo_desc_home_tr' || $s->key === 'seo_desc_tr') {
        $s->value = 'Türkiye’den dünyaya seçilmiş destinasyonları, karakter sahibi otelleri, restoranları, yatları ve seyahat hikâyelerini keşfedin.';
        $s->save();
        echo "Updated {$s->key}\n";
    }
    if ($s->key === 'seo_title_home_en' || $s->key === 'seo_title_en') {
        $s->value = 'DIOREAL — Travel, Destinations & Lifestyle';
        $s->save();
        echo "Updated {$s->key}\n";
    }
    if ($s->key === 'seo_desc_home_en' || $s->key === 'seo_desc_en') {
        $s->value = 'Discover selected destinations, distinctive hotels, restaurants, yachts and travel stories from Türkiye and around the world.';
        $s->save();
        echo "Updated {$s->key}\n";
    }
    
    // Clean string values
    if (is_string($s->value)) {
        if (strpos($s->value, 'premium markalar') !== false || strpos($s->value, 'lüks') !== false || strpos($s->value, 'luxury') !== false) {
            $newVal = str_replace(['premium markalar', 'premium markaları', 'lüks ', 'lüks', 'luxury ', 'luxury'], ['markalar', 'markaları', '', '', '', ''], $s->value);
            $s->value = $newVal;
            $s->save();
            echo "Cleaned setting {$s->key}\n";
        }
    }
}
