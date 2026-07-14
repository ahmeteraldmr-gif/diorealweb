<?php
$options = [
    'http' => [
        'method' => "GET",
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36\r\n"
    ],
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
    ]
];
$context = stream_context_create($options);
$html = file_get_contents("https://demo.acboz.com.tr/dioreal/public/journal", false, $context);

preg_match('/<section class="journal-section">([\s\S]*?)<\/section>/si', $html, $matches);
echo substr($matches[0] ?? 'NOT FOUND SECTION', 0, 5000);
