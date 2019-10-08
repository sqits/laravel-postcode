<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'postcode-nl::'], function () {

    Route::get('postcode/{postcode}/{houseNumber}/{houseNumberAddition?}', [
        'as' => 'address',
        'uses' => 'sqits\postcode\src\controllers\AddressController@show'
    ]);

});
