<?php

namespace Sqits\Postcode;

use Illuminate\Support\ServiceProvider;

class PostcodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/address.php', 'address'
        );

        // Routes
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');

        // Register the controller.
        $this->app->make('Sqits\Postcode\AddressController');
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
    }
}
