<?php

namespace App\Providers;

use App\View\Composers\PostComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // parámetros de forma global para ser usado en todas las vistas
        View::share('prueba', 'Esto es una variable global');

        View::composer('posts.*', function ($view) {
            $view->with('marca', 'Esto es una marca temporal...');
        });

        View::composer(['posts.index', 'posts.show'], function ($view) {
            $view->with('pais', 'Col');
        });

        View::composer('posts.*', PostComposer::class);
    }
}
