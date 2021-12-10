<?php

// Name: Vera Korchemnaya
// Description: Paginator
//      All I added here was:
//      use Illuminate\Pagination\Paginator;
//      Paginator::useBootstrap();
//  These are so that the records can be divided into 
//  sections and displayed on separate pages.

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // We added this line to pick a format for the 
        // paginator
        Paginator::useBootstrap();
    }
}
