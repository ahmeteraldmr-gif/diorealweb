<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Destination;

$dests = Destination::all();
foreach ($dests as $d) {
    $trName = is_array($d->name) ? ($d->name['tr'] ?? '') : $d->name;
    if (mb_stripos($trName, 'italya') !== false || mb_stripos($trName, 'İtalya') !== false) {
        $d->type = 'yurtdisi_popular';
        if (empty($d->img)) {
            $d->img = 'foto.img/amalfi.jpg';
        }
        $d->save();
        echo "✔ Fixed Destination '{$trName}': set type to yurtdisi_popular and img to {$d->img}\n";
    }
}

// Ensure no destination has an empty image
foreach (Destination::all() as $d) {
    if (empty($d->img)) {
        $d->img = 'foto.img/amalfi.jpg';
        $d->save();
        echo "✔ Fixed empty image for Destination ID {$d->id}\n";
    }
}
