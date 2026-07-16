<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SitemapController;

// Public Front-end Routes (clean URLs + legacy .html support)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/index.html', function() {
    return redirect()->route('home');
});

Route::get('/hakkimizda', [PageController::class, 'hakkimizda'])->name('hakkimizda');
Route::get('/hakkimizda.html', [PageController::class, 'hakkimizda']);

Route::get('/oteller', [PageController::class, 'oteller'])->name('oteller');
Route::get('/oteller.html', [PageController::class, 'oteller']);

Route::get('/yatlar', [PageController::class, 'yatlar'])->name('yatlar');
Route::get('/yatlar.html', [PageController::class, 'yatlar']);

Route::get('/restoranlar', [PageController::class, 'restoranlar'])->name('restoranlar');
Route::get('/restoranlar.html', [PageController::class, 'restoranlar']);

Route::get('/destinasyonlar', [PageController::class, 'geziRehberi'])->name('gezi-rehberi');
Route::get('/destinasyonlar.html', [PageController::class, 'geziRehberi']);
Route::get('/gezi-rehberi', function() {
    return redirect()->route('gezi-rehberi');
});
Route::get('/gezi-rehberi.html', function() {
    return redirect()->route('gezi-rehberi');
});

Route::get('/etkinlikler', [PageController::class, 'etkinlikler'])->name('etkinlikler');
Route::get('/etkinlikler.html', [PageController::class, 'etkinlikler']);

Route::get('/journal', [PageController::class, 'journal'])->name('journal');
Route::get('/journal.html', [PageController::class, 'journal']);

// Detail Pages
Route::get('/otel/{slug_or_id}', [PageController::class, 'otelDetay'])->name('otel.detay');
Route::get('/restoran/{slug_or_id}', [PageController::class, 'restoranDetay'])->name('restoran.detay');
Route::get('/journal/{slug_or_id}', [PageController::class, 'journalDetay'])->name('journal.detay');
Route::get('/destinasyon/{slug_or_id}', [PageController::class, 'destinasyonDetay'])->name('destinasyon.detay');
Route::get('/etkinlik/{slug_or_id}', [PageController::class, 'etkinlikDetay'])->name('etkinlik.detay');
Route::get('/rehber/{slug_or_id}', [PageController::class, 'rehberDetay'])->name('rehber.detay');
Route::get('/yat/{slug_or_id}', [PageController::class, 'yatDetay'])->name('yat.detay');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Force reset route for admin login and cache
Route::get('/force-reset-admin-login-1234', function() {
    \App\Models\User::updateOrCreate(
        ['id' => 1],
        [
            'name' => 'Kurucu Admin',
            'email' => 'DioTurkReal.13',
            'password' => \Illuminate\Support\Facades\Hash::make('xYdioReal.13xY'),
            'role' => 'super_admin'
        ]
    );

    try { \Illuminate\Support\Facades\Artisan::call('view:clear'); } catch (\Exception $e) {}
    try { \Illuminate\Support\Facades\Artisan::call('route:clear'); } catch (\Exception $e) {}
    try { \Illuminate\Support\Facades\Artisan::call('config:clear'); } catch (\Exception $e) {}
    try { \Illuminate\Support\Facades\Artisan::call('cache:clear'); } catch (\Exception $e) {}

    if (function_exists('opcache_reset')) {
        opcache_reset();
    }

    return "Her sey sifirdan basariyla kuruldu, veritabani guncellendi ve tum inatci onbellekler (OPcache) temizlendi! Lutfen /login sayfasina gidip giris yapin.";
});

Route::get('/force-migrate-1234', function() {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $output = \Illuminate\Support\Facades\Artisan::output();
        return "<pre>Migration Basariyla Tamamlandi:\n" . e($output) . "</pre>";
    } catch (\Exception $e) {
        return "<pre>Hata Olustu:\n" . e($e->getMessage()) . "\n" . e($e->getTraceAsString()) . "</pre>";
    }
});

Route::get('/view-log-1234', function() {
    $logPath = storage_path('logs/laravel.log');
    if (!file_exists($logPath)) {
        return "Log dosyasi bulunamadi.";
    }
    $content = file_get_contents($logPath);
    // Find all occurrences of environment.ERROR
    preg_match_all('/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\].*?\.ERROR.*?\n/', $content, $matches);
    $errors = array_slice($matches[0], -15);
    return "<h3>Son 15 Hata:</h3><pre>" . e(implode("", $errors)) . "</pre>";
});

Route::get('/debug-view-1234', function() {
    $file = '/home/dioreal/public_html/storage/framework/views/cec1c651ff01e71cf9dcffd64e525a3f.php';
    if (!file_exists($file)) {
        return "Compiled view file not found at " . $file;
    }
    $content = file_get_contents($file);
    // get first line
    $firstLine = strtok($content, "\n");
    return "<h3>First Line:</h3><pre>" . e($firstLine) . "</pre><h3>File Time:</h3><pre>" . date('Y-m-d H:i:s', filemtime($file)) . "</pre><h3>Around line 554:</h3><pre>" . e(implode("\n", array_slice(explode("\n", $content), 540, 30))) . "</pre>";
});

Route::get('/file-info-1234', function() {
    $files = [
        'index.blade.php' => '/home/dioreal/public_html/resources/views/index.blade.php',
        'compiled.php' => '/home/dioreal/public_html/storage/framework/views/cec1c651ff01e71cf9dcffd64e525a3f.php',
        'footer.blade.php' => '/home/dioreal/public_html/resources/views/partials/footer.blade.php',
    ];
    $out = "";
    foreach ($files as $name => $path) {
        if (file_exists($path)) {
            $out .= "$name:\n  Exists: Yes\n  Size: " . filesize($path) . "\n  Modified: " . date('Y-m-d H:i:s', filemtime($path)) . "\n  Perms: " . substr(sprintf('%o', fileperms($path)), -4) . "\n\n";
        } else {
            $out .= "$name:\n  Exists: No\n\n";
        }
    }
    return "<pre>$out</pre>";
});

Route::get('/view-index-1234', function() {
    $file = '/home/dioreal/public_html/resources/views/index.blade.php';
    if (!file_exists($file)) {
        return "index.blade.php not found";
    }
    return "<pre>" . e(file_get_contents($file)) . "</pre>";
});

Route::get('/view-file-1234', function(\Illuminate\Http\Request $request) {
    $path = $request->query('path');
    $file = '/home/dioreal/public_html/' . $path;
    if (!file_exists($file)) {
        return "File not found: " . $file;
    }
    return "<pre>" . e(file_get_contents($file)) . "</pre>";
});

Route::get('/blade-directives-1234', function() {
    $file = '/home/dioreal/public_html/resources/views/index.blade.php';
    if (!file_exists($file)) {
        return "index.blade.php not found";
    }
    $lines = file($file);
    $out = [];
    foreach ($lines as $i => $line) {
        if (preg_match('/^\s*@(if|endif|else|elseif|foreach|endforeach|php|endphp|include|extends|section|endsection)/i', $line, $matches)) {
            $out[] = ($i + 1) . ": " . trim($line);
        }
    }
    return "<pre>" . e(implode("\n", $out)) . "</pre>";
});

Route::get('/git-status-1234', function() {
    try {
        $output = shell_exec('git status 2>&1');
        return "<pre>Git Status:\n" . e($output) . "</pre>";
    } catch (\Exception $e) {
        return "Hata: " . $e->getMessage();
    }
});

Route::get('/git-pull-1234', function() {
    try {
        $output = shell_exec('git pull origin main 2>&1');
        return "<pre>Git Pull Output:\n" . e($output) . "</pre>";
    } catch (\Exception $e) {
        return "Hata: " . $e->getMessage();
    }
});

// Protected Admin Routes Group
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware(['permission:hotels'])->resource('hotels', App\Http\Controllers\Admin\HotelController::class);
    Route::middleware(['permission:restaurants'])->resource('restaurants', App\Http\Controllers\Admin\RestaurantController::class);
    Route::middleware(['permission:yachts'])->resource('yachts', App\Http\Controllers\Admin\YachtController::class);
    Route::middleware(['permission:guides'])->resource('guides', App\Http\Controllers\Admin\GuideController::class);
    Route::middleware(['permission:events'])->resource('events', App\Http\Controllers\Admin\EventController::class);
    Route::middleware(['permission:journals'])->resource('journals', App\Http\Controllers\Admin\JournalController::class);
    
    // Users Management
    Route::middleware(['permission:users'])->resource('users', App\Http\Controllers\Admin\UserController::class);
    
    // Destinations Management
    Route::middleware(['permission:destinations'])->resource('destinations', App\Http\Controllers\Admin\DestinationController::class);
    
    // Global Settings & Brands Management
    Route::middleware(['permission:settings'])->group(function () {
        Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        Route::post('settings/brands', [App\Http\Controllers\Admin\SettingController::class, 'addBrand'])->name('settings.add_brand');
        Route::delete('settings/brands/{index}', [App\Http\Controllers\Admin\SettingController::class, 'deleteBrand'])->name('settings.delete_brand');
    });
});

// Admin fallback redirects
Route::get('/admin.html', function() {
    return redirect()->route('admin.dashboard');
});

