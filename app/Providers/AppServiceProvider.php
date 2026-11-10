<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (!app()->runningInConsole()) {
            // When running via Apache on local subfolder (not artisan serve port 8000)
            if (request()->getPort() != 8000) {
                $root = request()->root();
                if (!str_contains($root, 'index.php')) {
                    URL::forceRootUrl($root . '/index.php');
                }
            }
        }
    }
}
