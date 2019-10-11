<?php

use Illuminate\Support\Facades\Route;

//Route::group(['as' => 'postcode-nl::', 'middleware' => 'web'], function () {
//    Route::get('postcode/{postcode}/{houseNumber}/{houseNumberAddition?}', 'AddressController@show');
//});

Route::group(['as' => 'postcode-nl::', 'middleware' => 'web'], function () {

    Route::get('postcode/{postcode}/{houseNumber}/{houseNumberAddition?}', [
        'as' => 'address',
        'uses' => 'sqits\postcode\controllers\AddressController@show',
        'middleware' => 'web'
    ]);

});
