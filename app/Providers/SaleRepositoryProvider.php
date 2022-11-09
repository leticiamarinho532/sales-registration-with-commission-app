<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SaleRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\Contracts\Interfaces\SaleRepositoryInterface", "App\Repositories\SaleRepository");
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
