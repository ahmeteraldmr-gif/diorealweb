<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Journal;
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

function scrapeModule($moduleName, $listUrlSlug, $detailRegex, $modelClass, $jsonFile, $modelType) {
    global $baseUrl;
    echo "\n--- SCRAPING {$moduleName} WITH ACCURATE LEAD & FULL BODY PARAGRAPHS ---\n";
    $listHtml = fetchPage("{$baseUrl}/{$listUrlSlug}");
    preg_match_all($detailRegex, $listHtml, $mLinks);
    $urls = array_values(array_unique($mLinks[1] ?? []));

    echo "Found " . count($urls) . " items for {$moduleName}.\n";

    $scrapedData = [];
    $usedSlugsTr = [];
    $usedSlugsEn = [];

    foreach ($urls as $idx => $url) {
        preg_match('/\/[a-z]+\/([0-9]+)/', $url, $mId);
        $id = (int)($mId[1] ?? ($idx + 1));
        $html = fetchPage($url);
        if (!$html) continue;

        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xpath = new DOMXPath($dom);

        // Title / Name
        $titleNode = $xpath->query('//h1[contains(@class, "page-title")] | //h1[contains(@class, "jd-title")] | //h1');
        $name = parseMultiLangText($titleNode->length ? $titleNode->item(0) : null, $xpath);

        // Eyebrow / Tag
        $eyebrowNode = $xpath->query('//span[contains(@class, "page-eyebrow")] | //div[contains(@class, "jd-eyebrow")]');
        $tag = parseMultiLangText($eyebrowNode->length ? $eyebrowNode->item(0) : null, $xpath);
        if (empty($tag['tr'])) { $tag = ['tr' => $moduleName, 'en' => $moduleName]; }

        // Cover Image
        $heroNode = $xpath->query('//div[contains(@class, "page-hero")] | //div[contains(@class, "jd-hero")]');
        $imgUrl = '';
        if ($heroNode->length) {
            if (preg_match('/url\([\'"]?([^\'")]+)[\'"]?\)/i', $heroNode->item(0)->getAttribute('style'), $mImg)) {
                $imgUrl = $mImg[1];
            }
        }
        $localImg = downloadImage($imgUrl);

        // Lead / Short Desc
        $leadNode = $xpath->query('//div[contains(@class, "jd-lead")]');
        if (!$leadNode->length) {
            $leadNode = $xpath->query('//div[contains(@class, "detail-story")] | //p[contains(@class, "card-desc")]');
        }
        $desc = parseMultiLangText($leadNode->length ? $leadNode->item(0) : null, $xpath);

        // Full Body Content
        $contentNode = $xpath->query('//div[contains(@class, "jd-content")]');
        if (!$contentNode->length) {
            $contentNode = $xpath->query('//div[contains(@class, "detail-story")] | //article[contains(@class, "jd-article")]');
        }
        $fullContent = parseMultiLangText($contentNode->length ? $contentNode->item(0) : null, $xpath);

        // Gallery
        $galleryNodes = $xpath->query('//div[contains(@class, "gallery-grid")]//img | //div[contains(@class, "jd-content")]//img');
        $gallery = [];
        foreach ($galleryNodes as $gNode) {
            $gSrc = $gNode->getAttribute('src');
            if ($gSrc) {
                $gallery[] = downloadImage($gSrc);
            }
        }

        $baseSlugTr = Str::slug($name['tr']) ?: "item-{$id}";
        $baseSlugEn = Str::slug($name['en'] ?: $name['tr']) ?: "item-{$id}";

        $slugTr = in_array($baseSlugTr, $usedSlugsTr) ? "{$baseSlugTr}-{$id}" : $baseSlugTr;
        $slugEn = in_array($baseSlugEn, $usedSlugsEn) ? "{$baseSlugEn}-{$id}" : $baseSlugEn;

        $usedSlugsTr[] = $slugTr;
        $usedSlugsEn[] = $slugEn;

        $itemData = [
            'id' => $id,
            'tag' => $tag,
            'img' => $localImg,
            'desc' => $desc,
            'slug_tr' => $slugTr,
            'slug_en' => $slugEn,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($modelType === 'journal') {
            $itemData['title'] = $name;
            $itemData['content'] = $fullContent;
            $itemData['date'] = date('Y-m-d');
        } elseif ($modelType === 'event') {
            $itemData['title'] = $name;
            $itemData['long_desc'] = $fullContent;
            $itemData['month'] = ['tr' => 'Temmuz', 'en' => 'July'];
            $itemData['loc'] = ['tr' => 'Türkiye', 'en' => 'Turkey'];
        } elseif ($modelType === 'guide') {
            $itemData['title'] = $name;
            $itemData['gallery'] = array_values(array_unique($gallery));
        } else { // hotel, yacht, restaurant
            $itemData['name'] = $name;
            $itemData['long_desc'] = $fullContent;
            $itemData['gallery'] = array_values(array_unique($gallery));
        }

        $scrapedData[] = $itemData;
        echo "  Imported: {$name['tr']} (ID: {$id}, Slug: {$slugTr})\n";
    }

    file_put_contents(storage_path("app/data/{$jsonFile}"), json_encode($scrapedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $modelClass::query()->truncate();
    foreach ($scrapedData as $item) {
        $modelClass::create($item);
    }
}

// SCRAPE ALL MODULES WITH ACCURATE LEAD & FULL BODY PARAGRAPHS
scrapeModule('Hotels', 'oteller.html', '/href=["\']([^"\']*\/otel\/[0-9]+)["\']/i', Hotel::class, 'dioreal_hotels_data.json', 'standard');
scrapeModule('Yachts', 'yatlar.html', '/href=["\']([^"\']*\/yat\/[0-9]+)["\']/i', Yacht::class, 'dioreal_yachts_data.json', 'standard');
scrapeModule('Restaurants', 'restoranlar.html', '/href=["\']([^"\']*\/restoran\/[0-9]+)["\']/i', Restaurant::class, 'dioreal_restaurants_data.json', 'standard');
scrapeModule('Guides', 'destinasyonlar.html', '/href=["\']([^"\']*\/rehber\/[0-9]+)["\']/i', Guide::class, 'dioreal_guide_data.json', 'guide');
scrapeModule('Events', 'etkinlikler.html', '/href=["\']([^"\']*\/etkinlik\/[0-9]+)["\']/i', Event::class, 'dioreal_events_data.json', 'event');
scrapeModule('Journals', 'journal.html', '/href=["\']([^"\']*\/journal\/[0-9]+)["\']/i', Journal::class, 'dioreal_journal_data.json', 'journal');

echo "\n=== ALL MODULES WITH FULL BODY PARAGRAPHS IMPORTED SUCCESSFULLY ===\n";
