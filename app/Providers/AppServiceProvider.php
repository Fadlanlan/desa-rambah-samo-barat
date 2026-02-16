<?php

namespace App\Providers;

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
        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            return $user->hasRole('super-admin') ? true : null;
        });

        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $village = \App\Models\Village::first() ?? new \App\Models\Village();
            $view->with('village', $village);
        });
    }
}
