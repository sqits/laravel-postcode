<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'postcode-nl::'], function () {
    Route::get('postcode/{postcode}/{houseNumber}/{houseNumberAddition?}', 'Sqits\Postcode\Controllers\AddressController@show');
});
