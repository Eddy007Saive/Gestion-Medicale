<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
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
    public function boot()
    {
        Inertia::share([
            'auth.user' => function () {
                if (Auth::check()) {
                    // Charger l'utilisateur connecté avec sa relation 'medecin'
                    return Auth::user()->load('medecin') ? [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'medecin' => Auth::user()->medecin, // Charger la relation 'medecin'
                    ] : null;
                }

                return null;
            },
        ]);
    }
}
