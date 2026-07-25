<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Destination;

echo "--- Hotel 1 --- \n";
$h = Hotel::first();
echo "Name: " . json_encode($h->name) . "\n";
echo "SEO Title TR: " . $h->seo_title_tr . "\n";
echo "SEO Title EN: " . $h->seo_title_en . "\n";
echo "SEO Desc TR: " . $h->seo_description_tr . "\n";

echo "--- Destination 1 --- \n";
$d = Destination::first();
echo "Name: " . json_encode($d->name) . "\n";
echo "SEO Title TR: " . $d->seo_title_tr . "\n";
echo "SEO Title EN: " . $d->seo_title_en . "\n";
echo "SEO Desc TR: " . $d->seo_description_tr . "\n";
