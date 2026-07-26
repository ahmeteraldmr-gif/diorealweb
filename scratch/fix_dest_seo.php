<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;

$dest = Destination::whereNull('seo_description_tr')->orWhere('seo_description_tr', '')->first();
if ($dest) {
    $trName = is_array($dest->name) ? ($dest->name['tr'] ?? '') : $dest->name;
    $trDesc = is_array($dest->desc) ? ($dest->desc['tr'] ?? '') : $dest->desc;
    $dest->seo_description_tr = !empty($trDesc) ? \Illuminate\Support\Str::limit(strip_tags($trDesc), 155) : "$trName destinasyonu lüks seyahat ve konaklama rehberi.";
    $dest->save();
    echo "✔ Populated missing SEO description for Destination: $trName\n";
}
