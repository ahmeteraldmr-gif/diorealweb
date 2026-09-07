<?php

namespace App\Providers;

use App\Overrides\HandleRequestsWithSubdir;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Livewire\Mechanisms\HandleRequests\HandleRequests;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * Livewire'ın HandleRequests sınıfını bizim override'ımızla
     * değiştiriyoruz. Bu sayede getUpdateUri() /public/livewire/update
     * döndürür.
     */
    public function register(): void
    {
        // Livewire'ın HandleRequests sınıfını override et
        if (class_exists(HandleRequests::class) && class_exists(HandleRequestsWithSubdir::class)) {
            $this->app->singleton(HandleRequests::class, HandleRequestsWithSubdir::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * Sunucu /public alt dizininde çalıştığı için Livewire update
     * POST endpoint'ini /public/livewire/update olarak kaydet.
     */
    public function boot(): void
    {
        if (class_exists(Livewire::class)) {
            $base = request()->getBaseUrl();
            $uri = ($base ? rtrim($base, '/') : '') . '/livewire/update';

            Livewire::setUpdateRoute(function ($handle) use ($uri) {
                return Route::post($uri, $handle)->middleware('web');
            });
        }
    }
}

