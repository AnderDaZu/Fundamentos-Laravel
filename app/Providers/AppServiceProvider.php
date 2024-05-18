<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // para establecer los estilos de bootstrap para la paginación
        // Paginator::useBootstrapFive();

        // para establecer los estilos de una vista como los por defecto para la paginación
        // Paginator::defaultView('vista custom que tiene estilos para la paginación');
    }
}
