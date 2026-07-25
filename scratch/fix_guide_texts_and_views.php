<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Guide;

echo "=== FIXING GUIDE TEXTS & DUMPING TO JSON ===\n";

$bodrumDescTr = "Birçok ziyaretçi doğrudan Yalıkavak Marina veya popüler plaj kulüplerine yönelir. Ancak Bodrum'un hikayesi çok daha derindir. Yaklaşık 2.500 yıldır bu yarımada Akdeniz'in en önemli denizcilik merkezlerinden biri olmuştur. Halikarnas'ın antik taşlarından St. Peter Kalesi'ne kadar nesiller bu turkuaz sulara hayran kalmıştır. Bodrum'u keşfetmek; beyaz badanalı köyleri, zeytinlikleri, gizli koyları ve dünya standartlarında süper yat marinalarını keşfetmek demektir.";

$yalikavakDescTr = "Yalıkavak, sakin bir balıkçı köyünden Akdeniz'in önde gelen süper yat destinasyonlarından birine dönüştü. Yalıkavak Marina'ya, üst düzey gastronomiye ve lüks butiklere ev sahipliği yapan belde, modern ihtişamı Ege mirasıyla sorunsuz bir şekilde harmanlıyor. Yakındaki Sandima köyü taş evlerini, tarihi rüzgar değirmenlerini ve bakir kıyı koylarını keşfedin.";

// Update Guide 4 (Bodrum)
$g4 = Guide::find(4);
if ($g4) {
    $desc = $g4->desc ?? [];
    $desc['tr'] = $bodrumDescTr;
    $g4->desc = $desc;
    $g4->seo_description_tr = \Illuminate\Support\Str::limit($bodrumDescTr, 155);
    $g4->save();
    echo "✔ Fixed Guide 4 (Bodrum)\n";
}

// Update Guide 5 (Yalıkavak)
$g5 = Guide::find(5);
if ($g5) {
    $desc = $g5->desc ?? [];
    $desc['tr'] = $yalikavakDescTr;
    $g5->desc = $desc;
    $g5->seo_description_tr = \Illuminate\Support\Str::limit($yalikavakDescTr, 155);
    $g5->save();
    echo "✔ Fixed Guide 5 (Yalıkavak)\n";
}

// Export to storage/app/data/dioreal_guide_data.json
$path = storage_path('app/data/dioreal_guide_data.json');
$allGuides = Guide::all()->toArray();
file_put_contents($path, json_encode($allGuides, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✔ Exported updated Guides to storage/app/data/dioreal_guide_data.json\n";

echo "Done.\n";
