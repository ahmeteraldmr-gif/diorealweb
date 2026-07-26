<?php
$adminCss = file_get_contents(__DIR__ . '/../public/css/admin-new.css');
$respCss = file_get_contents(__DIR__ . '/../public/css/responsive.css');

preg_match_all('/([^{}]+)\{([^}]+)\}/', $adminCss . $respCss, $matches, PREG_SET_ORDER);

foreach ($matches as $m) {
    $selector = trim($m[1]);
    $body = trim($m[2]);
    if (strpos($selector, 'sidebar') !== false) {
        echo "SELECTOR: $selector\nBODY:\n$body\n------------------------\n";
    }
}
