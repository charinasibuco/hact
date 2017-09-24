<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('Hact\RepositoryInterface', 'Hact\Repository');
        $this->app->bind('Hact\Checkup\Cart\ItemInterface', 'Hact\Checkup\Cart\Item');
    }
}
