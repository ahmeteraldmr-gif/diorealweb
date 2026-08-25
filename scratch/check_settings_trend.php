<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$settings = App\Models\Setting::pluck('value', 'key')->toArray();
foreach ($settings as $k => $v) {
    if (strpos($k, 'trend') !== false) {
        echo "{$k} => {$v}\n";
    }
}
