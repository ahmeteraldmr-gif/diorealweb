<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://demo.acboz.com.tr/dioreal/public/journal/14');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
$html = curl_exec($ch);
curl_close($ch);

file_put_contents('scratch/journal14.html', $html);
echo "Journal 14 HTML length: " . strlen($html) . "\n";
