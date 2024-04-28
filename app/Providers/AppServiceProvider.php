<?php

namespace App\Providers;

use App\Models\Cover;
use App\Observers\CoverObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use JeleDev\Shoppingcart\Facades\Cart;

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
        Event::listen(
            Login::class,
            function($event){
                Cart::instance('shopping')->restore($event->user->id);
            }
        );
        Cover::observe(CoverObserver::class);
    }
}
