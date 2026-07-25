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

function fetchUrl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

echo "=== STARTING SCRAPE FROM DEMO.ACBOZ.COM.TR ===\n";

// 1. SCRAPE OTELLER (HOTELS)
$otellerHtml = fetchUrl("{$baseUrl}/oteller.html");
preg_match_all('/href=["\']([^"\']*\/otel\/[0-9]+)["\']/i', $otellerHtml, $otelLinks);
$otelDetailUrls = array_unique($otelLinks[1] ?? []);

echo "Found " . count($otelDetailUrls) . " hotel detail links.\n";

foreach ($otelDetailUrls as $url) {
    echo "Fetching hotel: {$url}\n";
    $html = fetchUrl($url);
    if (!$html) continue;

    // Parse ID from URL
    preg_match('/\/otel\/([0-9]+)/', $url, $mId);
    $id = $mId[1] ?? null;

    // Extract DOM values using DOMDocument / regex
    $doc = new DOMDocument();
    @$doc->loadHTML('<?xml encoding="utf-8" ?>' . $html);
    $xpath = new DOMXPath($doc);

    // Title / Name
    $titleNode = $xpath->query('//h1[contains(@class, "page-title")] | //h1[contains(@class, "hero-title")] | //h1');
    $nameTr = $titleNode->length ? trim($titleNode->item(0)->nodeValue) : '';

    // If nameTr contains EN, split if necessary or extract
    echo "  Hotel Name: {$nameTr}\n";
}

echo "Scrape complete test.\n";
