<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\WebpageSetting;
use Illuminate\Support\Facades\View;
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
        // Pastikan model WebpageSetting bisa diakses di semua view
        View::composer('*', function ($view) {
            $webpage = WebpageSetting::first(); // ambil record pertama
            $view->with('webpage', $webpage);
        });

        Paginator::useBootstrapFive(); // atau useBootstrapFour() jika pakai BS4

    }
}
