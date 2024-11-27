<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notificacion;

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
