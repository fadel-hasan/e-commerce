<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component(\App\View\Components\Alert::class);
        Blade::component(\App\View\Components\statusText::class);
        Blade::component(\App\View\Components\chartJs::class);
        Blade::component(\App\View\Components\checkbox::class);
    }
}
