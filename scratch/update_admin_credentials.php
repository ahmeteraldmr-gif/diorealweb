<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== UPDATING ADMIN CREDENTIALS ===\n";

// Delete all existing users
User::query()->delete();

// Create sole admin user
$user = User::create([
    'email' => 'DioTurkReal.13',
    'name' => 'DioTurkReal.13',
    'password' => Hash::make('xYdioReal.13xY'),
    'role' => 'super_admin',
    'permissions' => ['hotels', 'restaurants', 'yachts', 'guides', 'events', 'journals', 'settings', 'users', 'destinations'],
]);

echo "✔ Successfully updated admin user!\n";
echo "  Kullanıcı Adı: DioTurkReal.13\n";
echo "  Şifre: xYdioReal.13xY\n";
echo "  Deleted all other users.\n";
