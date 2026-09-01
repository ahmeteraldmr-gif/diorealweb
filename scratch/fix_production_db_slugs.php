<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Destination;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Event;
use App\Models\Journal;

echo "1. Checking database columns...\n";
$tables = ['hotels', 'restaurants', 'events', 'guides', 'journals'];
foreach ($tables as $t) {
    if (Schema::hasTable($t) && !Schema::hasColumn($t, 'destination_id')) {
        Schema::table($t, function (Blueprint $table) {
            $table->unsignedBigInteger('destination_id')->nullable()->after('id');
        });
        echo "   Added 'destination_id' column to {$t}.\n";
    }
}

echo "2. Populating missing slugs...\n";

// Destinations
foreach (Destination::all() as $d) {
    $nameTr = $d->name['tr'] ?? $d->name['en'] ?? ('destinasyon-' . $d->id);
    $nameEn = $d->name['en'] ?? $d->name['tr'] ?? ('destination-' . $d->id);
    if (empty($d->slug_tr)) {
        $d->slug_tr = make_slug($nameTr, 'tr') ?: ('destinasyon-' . $d->id);
    }
    if (empty($d->slug_en)) {
        $d->slug_en = make_slug($nameEn, 'en') ?: $d->slug_tr;
    }
    $d->save();
    echo "   Destination ID {$d->id} -> TR: {$d->slug_tr} | EN: {$d->slug_en}\n";
}

// Guides
foreach (Guide::all() as $g) {
    $titleTr = $g->title['tr'] ?? $g->title['en'] ?? ('rehber-' . $g->id);
    $titleEn = $g->title['en'] ?? $g->title['tr'] ?? ('guide-' . $g->id);
    if (empty($g->slug_tr)) {
        $g->slug_tr = make_slug($titleTr, 'tr') ?: ('rehber-' . $g->id);
    }
    if (empty($g->slug_en)) {
        $g->slug_en = make_slug($titleEn, 'en') ?: $g->slug_tr;
    }
    $g->save();
    echo "   Guide ID {$g->id} -> TR: {$g->slug_tr} | EN: {$g->slug_en}\n";
}

// Hotels
foreach (Hotel::all() as $h) {
    $nameTr = $h->name['tr'] ?? $h->name['en'] ?? ('otel-' . $h->id);
    $nameEn = $h->name['en'] ?? $h->name['tr'] ?? ('hotel-' . $h->id);
    if (empty($h->slug_tr)) {
        $h->slug_tr = make_slug($nameTr, 'tr') ?: ('otel-' . $h->id);
    }
    if (empty($h->slug_en)) {
        $h->slug_en = make_slug($nameEn, 'en') ?: $h->slug_tr;
    }
    $h->save();
}

// Restaurants
foreach (Restaurant::all() as $r) {
    $nameTr = $r->name['tr'] ?? $r->name['en'] ?? ('restoran-' . $r->id);
    $nameEn = $r->name['en'] ?? $r->name['tr'] ?? ('restaurant-' . $r->id);
    if (empty($r->slug_tr)) {
        $r->slug_tr = make_slug($nameTr, 'tr') ?: ('restoran-' . $r->id);
    }
    if (empty($r->slug_en)) {
        $r->slug_en = make_slug($nameEn, 'en') ?: $r->slug_tr;
    }
    $r->save();
}

// Events
foreach (Event::all() as $e) {
    $titleTr = $e->title['tr'] ?? $e->title['en'] ?? ('etkinlik-' . $e->id);
    $titleEn = $e->title['en'] ?? $e->title['tr'] ?? ('event-' . $e->id);
    if (empty($e->slug_tr)) {
        $e->slug_tr = make_slug($titleTr, 'tr') ?: ('etkinlik-' . $e->id);
    }
    if (empty($e->slug_en)) {
        $e->slug_en = make_slug($titleEn, 'en') ?: $e->slug_tr;
    }
    $e->save();
}

// Auto link Bodrum entities
$bodrumDest = Destination::where('slug_tr', 'bodrum')->orWhere('id', 2)->first();
if ($bodrumDest) {
    foreach (Guide::all() as $g) {
        $titleStr = json_encode($g->title, JSON_UNESCAPED_UNICODE);
        if (stripos($titleStr, 'bodrum') !== false || stripos($titleStr, 'yalıkavak') !== false || stripos($g->slug_tr, 'bodrum') !== false || stripos($g->slug_tr, 'yalikavak') !== false) {
            $g->destination_id = $bodrumDest->id;
            $g->save();
        }
    }
    foreach (Hotel::all() as $h) {
        $locStr = json_encode($h->location, JSON_UNESCAPED_UNICODE);
        $nameStr = json_encode($h->name, JSON_UNESCAPED_UNICODE);
        if (stripos($locStr, 'bodrum') !== false || stripos($locStr, 'yalıkavak') !== false || stripos($nameStr, 'bodrum') !== false) {
            $h->destination_id = $bodrumDest->id;
            $h->save();
        }
    }
    foreach (Restaurant::all() as $r) {
        $locStr = json_encode($r->location, JSON_UNESCAPED_UNICODE);
        $nameStr = json_encode($r->name, JSON_UNESCAPED_UNICODE);
        if (stripos($locStr, 'bodrum') !== false || stripos($locStr, 'yalıkavak') !== false || stripos($nameStr, 'bodrum') !== false) {
            $r->destination_id = $bodrumDest->id;
            $r->save();
        }
    }
    foreach (Event::all() as $e) {
        $locStr = json_encode($e->location, JSON_UNESCAPED_UNICODE);
        $titleStr = json_encode($e->title, JSON_UNESCAPED_UNICODE);
        if (stripos($locStr, 'bodrum') !== false || stripos($locStr, 'yalıkavak') !== false || stripos($titleStr, 'bodrum') !== false) {
            $e->destination_id = $bodrumDest->id;
            $e->save();
        }
    }
}

echo "3. Production database slugs & destination relationships fixed successfully!\n";
