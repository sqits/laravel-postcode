<?php

namespace Sqits\Postcode;

use Illuminate\Support\ServiceProvider;
use Sqits\Postcode\Controllers\AddressController;
use Sqits\Postcode\Services\AddressService;
use Sqits\Postcode\Validators\AddressValidator;

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

        // Register the controller.
        $this->app->singleton(AddressController::class, function ($app) {
            return new AddressController($app[AddressService::class]);
        });

        // Register the service.
        $this->app->singleton(AddressService::class, function ($app) {
            return new AddressService($app[AddressValidator::class], $app[PostcodeClient::class]);
        });
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
