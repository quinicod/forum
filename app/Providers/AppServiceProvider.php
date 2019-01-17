<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\facades\schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \Blade::if('Logged', function() { 
            // “auth” es el sistema de autenticación que estamos utilizando 
            // y “check” nos dice si el usuario está o no autentificado 
            return auth()->check();
        });
    }
}
