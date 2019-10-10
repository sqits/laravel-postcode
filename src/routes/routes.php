<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'postcode-nl::', 'namespace' => 'Sqits\Postcode\Controllers'], function () {
    Route::get('postcode/{postcode}/{houseNumber}/{houseNumberAddition?}', 'AddressController@show');
});
