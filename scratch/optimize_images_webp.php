<?php
require __DIR__ . '/../vendor/autoload.php';

function convertToWebp($filePath) {
    $info = getimagesize($filePath);
    if (!$info) return false;
    
    $mime = $info['mime'];
    $webpPath = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $filePath);
    
    if (file_exists($webpPath) && filemtime($webpPath) >= filemtime($filePath)) {
        return $webpPath;
    }
    
    $image = null;
    if ($mime === 'image/jpeg') {
        $image = imagecreatefromjpeg($filePath);
    } elseif ($mime === 'image/png') {
        $image = imagecreatefrompng($filePath);
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
    }
    
    if ($image) {
        imagewebp($image, $webpPath, 85);
        imagedestroy($image);
        echo "Converted " . basename($filePath) . " -> " . basename($webpPath) . " (" . filesize($webpPath) . " bytes)\n";
        return $webpPath;
    }
    return false;
}

$dir = __DIR__ . '/../public/foto.img';
$files = glob($dir . '/*.{jpg,jpeg,png}', GLOB_BRACE);

foreach ($files as $file) {
    convertToWebp($file);
}

$uploadDir = __DIR__ . '/../public/uploads';
if (file_exists($uploadDir)) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($uploadDir));
    foreach ($iterator as $file) {
        if ($file->isFile() && preg_match('/\.(jpg|jpeg|png)$/i', $file->getFilename())) {
            convertToWebp($file->getPathname());
        }
    }
}

echo "All images converted to WebP successfully!\n";
