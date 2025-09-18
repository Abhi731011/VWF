<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\landing\LandingController;

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
        // Make footer data available to all views
        View::composer('landing.footer', function ($view) {
            $landingController = new LandingController();
            $footerData = $landingController->getFooterData();
            $view->with('footerData', $footerData);
        });
    }
}
