<?php
if (!extension_loaded('gd')) {
    echo "GD extension NOT loaded\n";
    exit(1);
}

$srcPath = __DIR__ . '/../public/foto.img/logo_dioreal.png';
$srcImg = imagecreatefromjpeg($srcPath);
if (!$srcImg) {
    $srcImg = imagecreatefrompng($srcPath);
}

if (!$srcImg) {
    echo "Could not load source image\n";
    exit(1);
}

$width = imagesx($srcImg);
$height = imagesy($srcImg);
echo "Loaded source image: {$width}x{$height}\n";

function resizeAndSavePng($srcImg, $w, $h, $destPath) {
    $destImg = imagecreatetruecolor($w, $h);
    imagealphablending($destImg, false);
    imagesavealpha($destImg, true);
    $transparent = imagecolorallocatealpha($destImg, 255, 255, 255, 127);
    imagefilledrectangle($destImg, 0, 0, $w, $h, $transparent);
    imagecopyresampled($destImg, $srcImg, 0, 0, 0, 0, $w, $h, imagesx($srcImg), imagesy($srcImg));
    imagepng($destImg, $destPath);
    imagedestroy($destImg);
    echo "Saved PNG ({$w}x{$h}): " . basename($destPath) . " (" . filesize($destPath) . " bytes)\n";
}

// Generate Google preferred sizes
resizeAndSavePng($srcImg, 48, 48, __DIR__ . '/../public/favicon-48x48.png');
resizeAndSavePng($srcImg, 192, 192, __DIR__ . '/../public/android-chrome-192x192.png');
resizeAndSavePng($srcImg, 512, 512, __DIR__ . '/../public/android-chrome-512x512.png');
resizeAndSavePng($srcImg, 180, 180, __DIR__ . '/../public/apple-touch-icon.png');
resizeAndSavePng($srcImg, 32, 32, __DIR__ . '/../public/favicon-32x32.png');
resizeAndSavePng($srcImg, 16, 16, __DIR__ . '/../public/favicon-16x16.png');

// Create a valid 48x48 PNG and copy to public/favicon.ico as well (browsers & Google accept PNG data in /favicon.ico or standard ICO)
// Also generate a true ICO header binary for /favicon.ico
$ico48Path = __DIR__ . '/../public/favicon-48x48.png';
$pngData = file_get_contents($ico48Path);

// Create ICO binary format header containing PNG
$icoHeader = pack('vvv', 0, 1, 1); // Reserved, Type 1 (ICO), 1 image
$icoDirectory = pack('CCCCvvVV', 48, 48, 0, 0, 1, 32, strlen($pngData), 6 + 16);
$icoData = $icoHeader . $icoDirectory . $pngData;
file_put_contents(__DIR__ . '/../public/favicon.ico', $icoData);
echo "Saved valid ICO (48x48): public/favicon.ico (" . filesize(__DIR__ . '/../public/favicon.ico') . " bytes)\n";

imagedestroy($srcImg);
echo "Favicon generation complete!\n";
