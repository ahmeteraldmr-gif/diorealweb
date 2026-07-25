<?php
function fetchPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [$code, $html];
}

for ($id = 1; $id <= 20; $id++) {
    $url = "https://demo.acboz.com.tr/dioreal/public/destinasyon/{$id}";
    list($code, $html) = fetchPage($url);
    if ($code == 200 && strpos($html, 'page-hero') !== false) {
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        $xpath = new DOMXPath($dom);
        $titleNode = $xpath->query('//h1');
        $title = $titleNode->length ? trim($titleNode->item(0)->nodeValue) : 'No title';
        echo "Found Destination ID {$id}: {$title}\n";
    }
}
