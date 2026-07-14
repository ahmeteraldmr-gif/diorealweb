<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (Schema::hasTable('settings')) {
                $settings = [];
                foreach (Setting::all() as $setting) {
                    $settings[$setting->key] = $setting->value;
                }
                View::share('settings', $settings);
            }
        } catch (\Exception $e) {
            // Safeguard to prevent artisan / migration crashes before database setup
        }

        // Custom Blade permission helper
        \Illuminate\Support\Facades\Blade::if('adminCan', function (string $permission) {
            if (session('is_admin') === true && !auth()->check()) {
                return true;
            }

            if (auth()->check()) {
                return auth()->user()->hasPermission($permission);
            }

            return false;
        });
    }
}
