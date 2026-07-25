<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;

$baseUrl = 'https://demo.acboz.com.tr/dioreal/public';

function getUrlContent($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

echo "=== IMPORTING ALL HOTELS FROM DEMO.ACBOZ.COM.TR ===\n";

$hotelsListHtml = getUrlContent("{$baseUrl}/oteller.html");

// Extract detail links
preg_match_all('/href=["\']([^"\']*\/otel\/[0-9]+)["\']/i', $hotelsListHtml, $matches);
$detailUrls = array_values(array_unique($matches[1] ?? []));

echo "Found " . count($detailUrls) . " hotel detail pages to scrape.\n";

$scrapedHotels = [];

foreach ($detailUrls as $index => $detailUrl) {
    preg_match('/\/otel\/([0-9]+)/', $detailUrl, $mId);
    $id = (int)($mId[1] ?? ($index + 1));
    echo "Processing Hotel ID {$id}: {$detailUrl}\n";

    $html = getUrlContent($detailUrl);
    if (!$html) continue;

    // Load HTML DOM
    $dom = new DOMDocument();
    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xpath = new DOMXPath($dom);

    // Extract Title / Name
    $titleNode = $xpath->query('//h1[contains(@class, "jd-title")] | //h1[contains(@class, "hero-title")] | //h1[contains(@class, "page-title")] | //h1');
    $nameTr = '';
    $nameEn = '';
    if ($titleNode->length) {
        $trSpan = $xpath->query('.//span[contains(@class, "lang-text-tr")]', $titleNode->item(0));
        $enSpan = $xpath->query('.//span[contains(@class, "lang-text-en")]', $titleNode->item(0));
        $nameTr = $trSpan->length ? trim($trSpan->item(0)->nodeValue) : trim($titleNode->item(0)->nodeValue);
        $nameEn = $enSpan->length ? trim($enSpan->item(0)->nodeValue) : $nameTr;
    }

    // Extract Tag
    $tagNode = $xpath->query('//span[contains(@class, "card-tag")] | //div[contains(@class, "jd-eyebrow")]');
    $tagTr = 'Otel';
    $tagEn = 'Hotel';
    if ($tagNode->length) {
        $trSpan = $xpath->query('.//span[contains(@class, "lang-text-tr")]', $tagNode->item(0));
        $enSpan = $xpath->query('.//span[contains(@class, "lang-text-en")]', $tagNode->item(0));
        if ($trSpan->length) $tagTr = trim($trSpan->item(0)->nodeValue);
        if ($enSpan->length) $tagEn = trim($enSpan->item(0)->nodeValue);
    }

    // Extract Hero / Cover Image
    $heroNode = $xpath->query('//div[contains(@class, "page-hero")] | //div[contains(@class, "jd-hero")] | //div[contains(@class, "hero")]');
    $img = 'foto.img/otel_maxx_royal.jpg';
    if ($heroNode->length) {
        $style = $heroNode->item(0)->getAttribute('style');
        if (preg_match('/url\([\'"]?([^\'")]+)[\'"]?\)/i', $style, $mImg)) {
            $img = $mImg[1];
        }
    }
    // Clean leading slashes
    $img = ltrim($img, '/');
    if (str_starts_with($img, 'http')) {
        $parsedPath = parse_url($img, PHP_URL_PATH);
        $img = ltrim($parsedPath, '/');
    }

    // Extract Description / Lead
    $leadNode = $xpath->query('//div[contains(@class, "jd-lead")] | //p[contains(@class, "card-desc")]');
    $descTr = '';
    $descEn = '';
    if ($leadNode->length) {
        $trSpan = $xpath->query('.//span[contains(@class, "lang-text-tr")]', $leadNode->item(0));
        $enSpan = $xpath->query('.//span[contains(@class, "lang-text-en")]', $leadNode->item(0));
        $descTr = $trSpan->length ? trim($trSpan->item(0)->nodeValue) : trim($leadNode->item(0)->nodeValue);
        $descEn = $enSpan->length ? trim($enSpan->item(0)->nodeValue) : $descTr;
    }

    // Extract Long Content
    $contentNode = $xpath->query('//div[contains(@class, "jd-content")]');
    $longDescTr = '';
    $longDescEn = '';
    if ($contentNode->length) {
        $trSpan = $xpath->query('.//div[contains(@class, "lang-text-tr")] | .//span[contains(@class, "lang-text-tr")]', $contentNode->item(0));
        $enSpan = $xpath->query('.//div[contains(@class, "lang-text-en")] | .//span[contains(@class, "lang-text-en")]', $contentNode->item(0));
        $longDescTr = $trSpan->length ? trim($dom->saveHTML($trSpan->item(0))) : trim($dom->saveHTML($contentNode->item(0)));
        $longDescEn = $enSpan->length ? trim($dom->saveHTML($enSpan->item(0))) : $longDescTr;
    }

    // Extract Gallery Images
    $galleryNodes = $xpath->query('//div[contains(@class, "jd-gallery")]//img | //div[contains(@class, "gallery")]//img');
    $gallery = [];
    foreach ($galleryNodes as $gNode) {
        $gSrc = $gNode->getAttribute('src');
        if ($gSrc) {
            $gSrc = ltrim($gSrc, '/');
            if (str_starts_with($gSrc, 'http')) {
                $gSrc = ltrim(parse_url($gSrc, PHP_URL_PATH), '/');
            }
            $gallery[] = $gSrc;
        }
    }
    if (empty($gallery)) {
        $gallery = ['foto.img/otel_museum.jpg', 'foto.img/otel_hillside.jpg'];
    }

    $hotelData = [
        'id' => $id,
        'name' => [
            'tr' => $nameTr ?: "Otel #{$id}",
            'en' => $nameEn ?: ($nameTr ?: "Hotel #{$id}")
        ],
        'tag' => [
            'tr' => $tagTr,
            'en' => $tagEn
        ],
        'img' => $img,
        'desc' => [
            'tr' => $descTr,
            'en' => $descEn
        ],
        'long_desc' => [
            'tr' => $longDescTr ?: $descTr,
            'en' => $longDescEn ?: $descEn
        ],
        'gallery' => array_values(array_unique($gallery)),
        'slug_tr' => Str::slug($nameTr),
        'slug_en' => Str::slug($nameEn ?: $nameTr),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'destination_id' => null,
        'order' => $index,
        'is_archived' => 0,
        'video_file' => null,
        'video_url' => null,
        'show_video_on_cover' => 0
    ];

    $scrapedHotels[] = $hotelData;
    echo "  Successfully parsed: {$nameTr} (ID: {$id})\n";
}

// Update JSON File
$jsonPath = storage_path('app/data/dioreal_hotels_data.json');
file_put_contents($jsonPath, json_encode($scrapedHotels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Saved " . count($scrapedHotels) . " hotels to {$jsonPath}\n";

// Update Database
Hotel::query()->truncate();
foreach ($scrapedHotels as $hData) {
    Hotel::create($hData);
}
echo "Database table 'hotels' updated successfully.\n";

echo "=== IMPORT COMPLETE ===\n";
