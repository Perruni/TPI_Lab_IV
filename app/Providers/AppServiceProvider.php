<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;
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

    public function boot()
    {

        Paginator::useBootstrapFive();

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $notificaciones = Notificacion::where('user_id', $userId)
                                              ->where('leido', false)
                                              ->get();
                $view->with('notificaciones', $notificaciones);
            }
        });
    }
    
}
