<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;
use Illuminate\Support\Str;

$baseUrl = 'https://demo.acboz.com.tr/dioreal/public';

function fetchPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

function downloadImage($urlPath) {
    if (!$urlPath) return 'foto.img/hero_4k.jpg';
    $urlPath = trim($urlPath);
    if (str_starts_with($urlPath, 'http')) {
        $fullUrl = $urlPath;
        $relPath = parse_url($urlPath, PHP_URL_PATH);
        $relPath = preg_replace('/^\/dioreal\/public\//', '', $relPath);
        $relPath = ltrim($relPath, '/');
    } else {
        $relPath = ltrim($urlPath, '/');
        $fullUrl = "https://demo.acboz.com.tr/dioreal/public/{$relPath}";
    }

    $localFilePath = public_path($relPath);
    $dir = dirname($localFilePath);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    if (!file_exists($localFilePath) || filesize($localFilePath) === 0) {
        $imgData = fetchPage($fullUrl);
        if ($imgData && strlen($imgData) > 100) {
            file_put_contents($localFilePath, $imgData);
        }
    }

    return $relPath;
}

function parseMultiLangText($node, $xpath) {
    if (!$node) return ['tr' => '', 'en' => ''];
    $trSpan = $xpath->query('.//*[contains(@class, "lang-text-tr")]', $node);
    $enSpan = $xpath->query('.//*[contains(@class, "lang-text-en")]', $node);

    $tr = '';
    $en = '';

    if ($trSpan->length) {
        $trNode = $trSpan->item(0);
        $domDoc = $trNode->ownerDocument;
        $tr = trim($domDoc->saveHTML($trNode));
        $tr = preg_replace('/^<div[^>]*>(.*)<\/div>$/is', '$1', $tr);
        $tr = preg_replace('/^<span[^>]*>(.*)<\/span>$/is', '$1', $tr);
    } else {
        $tr = trim($node->nodeValue);
    }

    if ($enSpan->length) {
        $enNode = $enSpan->item(0);
        $domDoc = $enNode->ownerDocument;
        $en = trim($domDoc->saveHTML($enNode));
        $en = preg_replace('/^<div[^>]*>(.*)<\/div>$/is', '$1', $en);
        $en = preg_replace('/^<span[^>]*>(.*)<\/span>$/is', '$1', $en);
    } else {
        $en = $tr;
    }

    return [
        'tr' => trim(strip_tags($tr, '<p><br><b><i><strong><em><h2><h3><h4><ul><li><a><div>')),
        'en' => trim(strip_tags($en, '<p><br><b><i><strong><em><h2><h3><h4><ul><li><a><div>'))
    ];
}

$scrapedDestinations = [];
$usedSlugsTr = [];
$usedSlugsEn = [];

echo "\n--- SCRAPING ALL DESTINATIONS (1 TO 22) FROM DEMO SITE ---\n";

for ($id = 1; $id <= 25; $id++) {
    $url = "{$baseUrl}/destinasyon/{$id}";
    $html = fetchPage($url);
    if (!$html || strpos($html, 'page-hero') === false) continue;

    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xpath = new DOMXPath($dom);

    // Title / Name
    $titleNode = $xpath->query('//h1[contains(@class, "page-title")] | //h1');
    $name = parseMultiLangText($titleNode->length ? $titleNode->item(0) : null, $xpath);

    // Region / Eyebrow
    $regionNode = $xpath->query('//span[contains(@class, "page-eyebrow")]');
    $region = parseMultiLangText($regionNode->length ? $regionNode->item(0) : null, $xpath);

    // Cover Image
    $heroNode = $xpath->query('//div[contains(@class, "page-hero")]');
    $imgUrl = '';
    if ($heroNode->length) {
        if (preg_match('/url\([\'"]?([^\'")]+)[\'"]?\)/i', $heroNode->item(0)->getAttribute('style'), $mImg)) {
            $imgUrl = $mImg[1];
        }
    }
    $localImg = downloadImage($imgUrl);

    // Description text block
    $descNode = $xpath->query('//section[contains(@class, "dest-intro")]');
    $desc = parseMultiLangText($descNode->length ? $descNode->item(0) : null, $xpath);

    // Gallery
    $galleryNodes = $xpath->query('//div[contains(@class, "gallery-grid")]//img');
    $gallery = [];
    foreach ($galleryNodes as $gNode) {
        $gSrc = $gNode->getAttribute('src');
        if ($gSrc) {
            $gallery[] = downloadImage($gSrc);
        }
    }

    $baseSlugTr = Str::slug($name['tr']) ?: "destinasyon-{$id}";
    $baseSlugEn = Str::slug($name['en'] ?: $name['tr']) ?: "destinasyon-{$id}";

    $slugTr = in_array($baseSlugTr, $usedSlugsTr) ? "{$baseSlugTr}-{$id}" : $baseSlugTr;
    $slugEn = in_array($baseSlugEn, $usedSlugsEn) ? "{$baseSlugEn}-{$id}" : $baseSlugEn;

    $usedSlugsTr[] = $slugTr;
    $usedSlugsEn[] = $slugEn;

    $destData = [
        'id' => $id,
        'name' => $name,
        'region' => $region,
        'img' => $localImg,
        'desc' => $desc,
        'gallery' => array_values(array_unique($gallery)),
        'slug_tr' => $slugTr,
        'slug_en' => $slugEn,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    $scrapedDestinations[] = $destData;
    echo "  Scraped Destination ID {$id}: {$name['tr']} (Slug: {$slugTr})\n";
}

file_put_contents(storage_path("app/data/dioreal_destinations_data.json"), json_encode($scrapedDestinations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

Destination::query()->truncate();
foreach ($scrapedDestinations as $d) {
    Destination::create($d);
}

echo "\n=== ALL DESTINATIONS IMPORTED & SEEDED SUCCESSFULLY (" . count($scrapedDestinations) . " Total) ===\n";
