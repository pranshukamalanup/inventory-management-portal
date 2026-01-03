<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Customer Auth Routes (NO auth middleware here)
|--------------------------------------------------------------------------
*/

Route::get('/customer/login', function () {
    return 'Customer Login Page';
});

/*
|--------------------------------------------------------------------------
| Customer Protected Routes
|--------------------------------------------------------------------------
*/

Route::prefix('customer')
    ->middleware('auth:customer')
    ->group(function () {

        Route::get('/dashboard', function () {
            return 'Customer Dashboard';
        });

    });
