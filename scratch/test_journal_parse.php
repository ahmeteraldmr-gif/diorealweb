<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$html = file_get_contents('scratch/journal14.html');

$dom = new DOMDocument();
@$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
$xpath = new DOMXPath($dom);

function parseMultiLangTextFix($node, $xpath) {
    if (!$node) return ['tr' => '', 'en' => ''];
    $trSpan = $xpath->query('.//*[contains(@class, "lang-text-tr")]', $node);
    $enSpan = $xpath->query('.//*[contains(@class, "lang-text-en")]', $node);

    $tr = '';
    $en = '';

    if ($trSpan->length) {
        $trNode = $trSpan->item(0);
        $domDoc = $trNode->ownerDocument;
        $tr = trim($domDoc->saveHTML($trNode));
        $tr = preg_replace('/^<div[^>]*>(.*)<\/div>$/is', '$1', $tr);
        $tr = preg_replace('/^<span[^>]*>(.*)<\/span>$/is', '$1', $tr);
    } else {
        $tr = trim($node->nodeValue);
    }

    if ($enSpan->length) {
        $enNode = $enSpan->item(0);
        $domDoc = $enNode->ownerDocument;
        $en = trim($domDoc->saveHTML($enNode));
        $en = preg_replace('/^<div[^>]*>(.*)<\/div>$/is', '$1', $en);
        $en = preg_replace('/^<span[^>]*>(.*)<\/span>$/is', '$1', $en);
    } else {
        $en = $tr;
    }

    return ['tr' => trim(strip_tags($tr, '<p><br><b><i><strong><em><h2><h3><h4><ul><li><a><div>')), 'en' => trim(strip_tags($en, '<p><br><b><i><strong><em><h2><h3><h4><ul><li><a><div>'))];
}

$leadNode = $xpath->query('//div[contains(@class, "jd-lead")]');
$contentNode = $xpath->query('//div[contains(@class, "jd-content")]');

$lead = parseMultiLangTextFix($leadNode->length ? $leadNode->item(0) : null, $xpath);
$content = parseMultiLangTextFix($contentNode->length ? $contentNode->item(0) : null, $xpath);

echo "--- LEAD (TR) ---\n" . $lead['tr'] . "\n\n";
echo "--- FULL CONTENT (TR) ---\n" . $content['tr'] . "\n";
