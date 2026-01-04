<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes (NO auth middleware)
|--------------------------------------------------------------------------
*/

Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm']);
Route::post('/customer/login', [CustomerAuthController::class, 'login']);

Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm']);
Route::post('/customer/register', [CustomerAuthController::class, 'register']);

Route::post('/customer/logout', [CustomerAuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Customer Protected Routes
|--------------------------------------------------------------------------
*/

Route::prefix('customer')
    ->middleware('auth:customer')
    ->group(function () {

        Route::get('/dashboard', [CustomerDashboardController::class, 'index']);

    });

