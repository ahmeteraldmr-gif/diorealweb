<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://demo.acboz.com.tr/dioreal/public/destinasyon/3');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
$html = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Code: $code\n";
echo "HTML Length: " . strlen($html) . "\n";
file_put_contents('scratch/dest3.html', $html);
