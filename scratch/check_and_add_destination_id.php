<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Event;
use App\Models\Guide;

$tables = ['hotels', 'restaurants', 'events', 'guides'];

foreach ($tables as $t) {
    if (!Schema::hasColumn($t, 'destination_id')) {
        Schema::table($t, function (Blueprint $table) {
            $table->unsignedBigInteger('destination_id')->nullable()->after('id');
        });
        echo "Added column 'destination_id' to table {$t}.\n";
    } else {
        echo "Table {$t} already has 'destination_id' column.\n";
    }
}

// Map existing items to Bodrum (ID 2 or destination slug 'bodrum') if location/tag matches 'bodrum' or 'yalikavak' or 'gumusluk' or 'turkbuku'
$bodrumDest = Destination::where('slug_tr', 'bodrum')->orWhere('id', 2)->first();

if ($bodrumDest) {
    echo "Found Bodrum Destination ID: {$bodrumDest->id}\n";
    
    // Connect Bodrum guides
    foreach (Guide::all() as $g) {
        $titleStr = json_encode($g->title, JSON_UNESCAPED_UNICODE);
        $tagStr = json_encode($g->tag, JSON_UNESCAPED_UNICODE);
        if (stripos($titleStr, 'bodrum') !== false || stripos($titleStr, 'yalıkavak') !== false || stripos($tagStr, 'bodrum') !== false || stripos($g->slug_tr, 'bodrum') !== false || stripos($g->slug_tr, 'yalikavak') !== false) {
            $g->destination_id = $bodrumDest->id;
            $g->save();
            echo "Linked Guide ID {$g->id} ({$titleStr}) -> Bodrum (ID {$bodrumDest->id})\n";
        }
    }

    // Connect Bodrum hotels
    foreach (Hotel::all() as $h) {
        $locStr = json_encode($h->location, JSON_UNESCAPED_UNICODE);
        $nameStr = json_encode($h->name, JSON_UNESCAPED_UNICODE);
        if (stripos($locStr, 'bodrum') !== false || stripos($locStr, 'yalıkavak') !== false || stripos($nameStr, 'bodrum') !== false) {
            $h->destination_id = $bodrumDest->id;
            $h->save();
            echo "Linked Hotel ID {$h->id} ({$nameStr}) -> Bodrum (ID {$bodrumDest->id})\n";
        }
    }

    // Connect Bodrum restaurants
    foreach (Restaurant::all() as $r) {
        $locStr = json_encode($r->location, JSON_UNESCAPED_UNICODE);
        $nameStr = json_encode($r->name, JSON_UNESCAPED_UNICODE);
        if (stripos($locStr, 'bodrum') !== false || stripos($locStr, 'yalıkavak') !== false || stripos($nameStr, 'bodrum') !== false) {
            $r->destination_id = $bodrumDest->id;
            $r->save();
            echo "Linked Restaurant ID {$r->id} ({$nameStr}) -> Bodrum (ID {$bodrumDest->id})\n";
        }
    }

    // Connect Bodrum events
    foreach (Event::all() as $e) {
        $locStr = json_encode($e->location, JSON_UNESCAPED_UNICODE);
        $titleStr = json_encode($e->title, JSON_UNESCAPED_UNICODE);
        if (stripos($locStr, 'bodrum') !== false || stripos($locStr, 'yalıkavak') !== false || stripos($titleStr, 'bodrum') !== false) {
            $e->destination_id = $bodrumDest->id;
            $e->save();
            echo "Linked Event ID {$e->id} ({$titleStr}) -> Bodrum (ID {$bodrumDest->id})\n";
        }
    }
}
