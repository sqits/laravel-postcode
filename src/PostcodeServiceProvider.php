<?php

namespace Sqits\Postcode;

use Illuminate\Support\ServiceProvider;

class PostcodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/address.php', 'address'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config file.
        $this->publishes([
            __DIR__.'/../config/address.php' => config_path('address.php'),
        ], 'config');

        // Routes
        if (array_get($this->app['config'], 'address.enableRoutes', false) and ! $this->app->routesAreCached()) {
            $this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        }
    }
}
