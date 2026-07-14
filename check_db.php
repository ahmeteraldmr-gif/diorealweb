<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

echo "--- LOCAL GUIDES ---\n";
foreach (\App\Models\Guide::all() as $g) {
    echo "ID: " . $g->id . "\n";
    echo "  Title: " . print_r($g->title, true) . "\n";
    echo "  Tag: " . print_r($g->tag, true) . "\n";
    echo "  Desc (length): " . strlen(print_r($g->desc, true)) . "\n";
}
