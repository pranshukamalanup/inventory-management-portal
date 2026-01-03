<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Auth Routes (NO auth middleware here)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', function () {
    return 'Admin Login Page';
});

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth:admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            return 'Admin Dashboard Here';
        });

    });
