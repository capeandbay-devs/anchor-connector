<?php

/*
|--------------------------------------------------------------------------
| AnchorCMS Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the CapeAndBay\AnchorCMS package.
|
*/

Route::group(
    [
        'namespace'  => 'CapeAndBay\AnchorCMS\app\Http\Controllers',
        'middleware' => 'web'
    ],
    function() {
        Route::get('auto-log/{uuid}', 'Auth\SSOLoginController@login');
    }
);

