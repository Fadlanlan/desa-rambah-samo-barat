<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Warga\WargaService;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WargaService::class);
        $this->app->bind(\App\Services\News\NewsService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    //
    }
}
