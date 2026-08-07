<?php
$logoPath = __DIR__ . '/../public/foto.img/logo_dioreal.png';
if (file_exists($logoPath)) {
    $info = getimagesize($logoPath);
    echo "Dimensions: " . $info[0] . "x" . $info[1] . " | Mime: " . $info['mime'] . "\n";
} else {
    echo "File not found: " . $logoPath . "\n";
}

$publicFiles = glob(__DIR__ . '/../public/*');
foreach ($publicFiles as $f) {
    echo "Public file: " . basename($f) . "\n";
}
