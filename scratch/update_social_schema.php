<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

App\Models\Setting::set('instagram', 'https://www.instagram.com/diorealcom');
App\Models\Setting::set('linkedin', 'https://www.linkedin.com/company/diorealcom/');

echo "Updated DB settings for instagram and linkedin social links successfully!\n";
