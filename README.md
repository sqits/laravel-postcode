# Laravel wrapper for postcode-nl api

## Installation and usage
This package requires PHP 7.2 and Laravel 5.8 or higher. Install the package by running the following command in your console;

``` bash
composer require sqits/laravel-postcode
```

You can publish the config file with:

``` bash
php artisan vendor:publish --provider="Sqits\Postcode\PostcodeServiceProvider" --tag="config"
```

This is the contents of the published config file:

``` php
 /*
     * Request options required for GuzzleHttp client.
     */
    'requestOptions' => [
        
        /*
         * URI
         *
         * Settings which api url the package should use. There are several endpoints available
         */
        'uri' => [
            'extension' => env('POSTCODENL_URI_EXTENSION', 'nl'),
        ],
        
        /*
         * Authentication
         *
         * Register an account with Postcode.nl to obtain a key and secret. See https://api.postcode.nl/#register for
         * further information.
         */
        'auth' => [
            env('POSTCODENL_KEY', null),
            env('POSTCODENL_SECRET', null)
        ],

        /*
         * Timeout (in seconds)
         *
         * By default, the client waits 10 seconds for a response. You may set a different timeout.
         */
        'timeout' => env('POSTCODENL_TIMEOUT', 10),

    ],

    /*
     * Enable routes
     *
     * This package comes with a set of routes, which are not loaded by default. In order to use them, set this
     * option to true.
     */
    'enableRoutes' => env('POSTCODENL_ENABLE_ROUTES', false),
```

### Using the JSON API

In order to use the API, enabled it in the configuration. When enabled, the following route is available:
                                                                         
```php
route('postcode-nl::address', [$postcode, $houseNumber, $houseNumberAddition = null]);
```

or use the following URL (e.g. for AJAX calls):

```
/postcode-nl/address/{postcode}/{houseNumber}/{houseNumberAddition?}
```

## Configuration

### Credentials (required)

The key and secret are used for authentication. Without them, you cannot use the service. 

```ini
POSTCODENL_KEY=<your-api-key>
POSTCODENL_SECRET=<your-secret>
```

### Enable routes (optional)

This package comes with a ready to use JSON API, which is disabled by default. You can enable it like so:  

```ini
POSTCODENL_ENABLE_ROUTES=true
```

### Timeout (in seconds, optional)

By default, the client waits 10 seconds for a response. You may set a different timeout.

```ini
POSTCODENL_TIMEOUT=<timeout-in-seconds>
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security-related issues, please [email](mailto:info@sqits.nl) to info@sqits.nl instead of using the issue tracker.


## Credits

- [Sqits](https://github.com/sqits)
- [Milan Jansen](https://github.com/MilanJn)
- [Ruud Schaaphuizen](https://github.com/rschaaphuizen)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
