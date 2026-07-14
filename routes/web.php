<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApiController;

// Public Front-end Routes (clean URLs + legacy .html support)
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
Route::get('/otel/{id}', [PageController::class, 'otelDetay'])->name('otel.detay');
Route::get('/restoran/{id}', [PageController::class, 'restoranDetay'])->name('restoran.detay');
Route::get('/journal/{id}', [PageController::class, 'journalDetay'])->name('journal.detay');
Route::get('/destinasyon/{id}', [PageController::class, 'destinasyonDetay'])->name('destinasyon.detay');
Route::get('/etkinlik/{id}', [PageController::class, 'etkinlikDetay'])->name('etkinlik.detay');
Route::get('/rehber/{id}', [PageController::class, 'rehberDetay'])->name('rehber.detay');
Route::get('/yat/{id}', [PageController::class, 'yatDetay'])->name('yat.detay');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

