<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;

echo "1. Normalizing Destination array attributes...\n";
foreach (Destination::all() as $d) {
    $changed = false;
    foreach (['name', 'region', 'desc'] as $col) {
        $val = $d->getRawOriginal($col);
        if (is_string($val) && !empty($val)) {
            $decoded = json_decode($val, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                $d->$col = ['tr' => $val, 'en' => $val];
                $changed = true;
            }
        }
    }
    if ($changed) {
        $d->save();
        echo "   Fixed Destination ID {$d->id}\n";
    }
}

echo "2. Normalizing Hotel array attributes...\n";
foreach (Hotel::all() as $h) {
    $changed = false;
    foreach (['name', 'tag', 'location', 'desc'] as $col) {
        $val = $h->getRawOriginal($col);
        if (is_string($val) && !empty($val)) {
            $decoded = json_decode($val, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                $h->$col = ['tr' => $val, 'en' => $val];
                $changed = true;
            }
        }
    }
    if ($changed) {
        $h->save();
    }
}

echo "3. Normalizing Restaurant array attributes...\n";
foreach (Restaurant::all() as $r) {
    $changed = false;
    foreach (['name', 'tag', 'location', 'desc'] as $col) {
        $val = $r->getRawOriginal($col);
        if (is_string($val) && !empty($val)) {
            $decoded = json_decode($val, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                $r->$col = ['tr' => $val, 'en' => $val];
                $changed = true;
            }
        }
    }
    if ($changed) {
        $r->save();
    }
}

echo "4. Normalizing Guide array attributes...\n";
foreach (Guide::all() as $g) {
    $changed = false;
    foreach (['title', 'tag', 'desc'] as $col) {
        $val = $g->getRawOriginal($col);
        if (is_string($val) && !empty($val)) {
            $decoded = json_decode($val, true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($decoded)) {
                $g->$col = ['tr' => $val, 'en' => $val];
                $changed = true;
            }
        }
    }
    if ($changed) {
        $g->save();
    }
}

echo "✔ Data normalization complete!\n";
