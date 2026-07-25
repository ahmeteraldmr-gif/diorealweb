<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;

$typeMap = [
    1 => 'turkiye',           // İstanbul
    2 => 'turkiye',           // Bodrum
    3 => 'turkiye',           // Fethiye
    4 => 'turkiye',           // Kapadokya
    5 => 'turkiye',           // Çeşme
    6 => 'turkiye',           // Kaş
    7 => 'turkiye',           // Datça

    8 => 'yurtdisi_popular',   // Maldivler
    9 => 'yurtdisi_popular',   // Japonya
    10 => 'yurtdisi_popular',  // Patagonya
    11 => 'yurtdisi_popular',  // Amalfi Kıyısı
    12 => 'yurtdisi_popular',  // Norveç Fiyortları
    13 => 'yurtdisi_popular',  // Sahra Çölü

    14 => 'yurtdisi_traveller',// İsviçre Alpleri
    15 => 'yurtdisi_traveller',// İzlanda
    16 => 'yurtdisi_traveller',// Kosta Rika

    17 => 'yurtdisi_month',    // Toskana
    18 => 'yurtdisi_month',    // Kyoto

    19 => 'yurtdisi_spotlight',// Lapland
    20 => 'yurtdisi_spotlight',// Seyşeller
    21 => 'yurtdisi_spotlight',// Petra Antik Kenti
    22 => 'yurtdisi_spotlight',// Paris
];

$filePath = storage_path('app/data/dioreal_destinations_data.json');
$data = json_decode(file_get_contents($filePath), true);

foreach ($data as &$item) {
    $id = (int)$item['id'];
    if (isset($typeMap[$id])) {
        $item['type'] = $typeMap[$id];
    } else {
        $item['type'] = 'yurtdisi_spotlight';
    }
}

file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

foreach ($data as $item) {
    Destination::where('id', $item['id'])->update(['type' => $item['type']]);
}

echo "=== DESTINATION TYPES UPDATED ACCORDING TO DEMO SITE ===\n";
foreach (Destination::all() as $d) {
    echo "- ID {$d->id}: {$d->name['tr']} => Type: {$d->type}\n";
}
