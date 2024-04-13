<?php

namespace App\Providers;

use App\Models\Cover;
use App\Observers\CoverObserver;
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
        Cover::observe(CoverObserver::class);
    }
}
