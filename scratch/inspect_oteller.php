<?php
function getUrl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

$html = getUrl('https://demo.acboz.com.tr/dioreal/public/oteller.html');
echo "HTML length: " . strlen($html) . "\n";
file_put_contents('scratch/oteller_page.html', $html);

// Dump hotel 1 detail html
$hotel1Html = getUrl('https://demo.acboz.com.tr/dioreal/public/otel/1');
file_put_contents('scratch/hotel1_page.html', $hotel1Html);
echo "Hotel 1 HTML length: " . strlen($hotel1Html) . "\n";
