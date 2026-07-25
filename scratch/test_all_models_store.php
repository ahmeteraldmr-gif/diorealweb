<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Journal;
use App\Models\Destination;

$tests = [
    'Hotel' => function() {
        return Hotel::create([
            'name' => ['tr' => 'Test H', 'en' => 'Test H'],
            'location' => ['tr' => 'Loc', 'en' => 'Loc'],
            'desc' => ['tr' => 'Desc', 'en' => 'Desc'],
            'img' => 'foto.img/otel_aman.jpg'
        ]);
    },
    'Restaurant' => function() {
        return Restaurant::create([
            'name' => ['tr' => 'Test R', 'en' => 'Test R'],
            'location' => ['tr' => 'Loc', 'en' => 'Loc'],
            'desc' => ['tr' => 'Desc', 'en' => 'Desc'],
            'img' => 'foto.img/otel_aman.jpg'
        ]);
    },
    'Yacht' => function() {
        return Yacht::create([
            'name' => ['tr' => 'Test Y', 'en' => 'Test Y'],
            'desc' => ['tr' => 'Desc', 'en' => 'Desc'],
            'img' => 'foto.img/otel_aman.jpg'
        ]);
    },
    'Event' => function() {
        return Event::create([
            'title' => ['tr' => 'Test E', 'en' => 'Test E'],
            'day' => '15',
            'month' => ['tr' => 'Ocak', 'en' => 'January'],
            'loc' => ['tr' => 'Loc', 'en' => 'Loc'],
            'desc' => ['tr' => 'Desc', 'en' => 'Desc'],
            'img' => 'foto.img/otel_aman.jpg'
        ]);
    },
    'Guide' => function() {
        return Guide::create([
            'title' => ['tr' => 'Test G', 'en' => 'Test G'],
            'desc' => ['tr' => 'Desc', 'en' => 'Desc'],
            'img' => 'foto.img/otel_aman.jpg'
        ]);
    },
    'Journal' => function() {
        return Journal::create([
            'title' => ['tr' => 'Test J', 'en' => 'Test J'],
            'date' => '2026-07-25',
            'desc' => ['tr' => 'Desc', 'en' => 'Desc'],
            'img' => 'foto.img/otel_aman.jpg'
        ]);
    },
    'Destination' => function() {
        return Destination::create([
            'name' => ['tr' => 'Test D', 'en' => 'Test D'],
            'region' => ['tr' => 'Reg', 'en' => 'Reg'],
            'type' => 'turkiye',
            'img' => 'foto.img/otel_aman.jpg'
        ]);
    },
];

foreach ($tests as $name => $callback) {
    try {
        $item = $callback();
        echo "✔ $name store succeeded (ID: {$item->id})\n";
        $item->delete();
    } catch (\Throwable $e) {
        echo "❌ $name store failed: " . $e->getMessage() . "\n";
    }
}
