<?php
$favPath = __DIR__ . '/../public/favicon.ico';
if (file_exists($favPath)) {
    echo "favicon.ico size: " . filesize($favPath) . " bytes\n";
    $info = @getimagesize($favPath);
    if ($info) {
        echo "favicon.ico dimensions: " . $info[0] . "x" . $info[1] . " | Mime: " . $info['mime'] . "\n";
    } else {
        echo "favicon.ico is not a valid image or binary ico\n";
    }
} else {
    echo "public/favicon.ico does not exist\n";
}
