<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ProductController;

/*
|--------------------------------------------------------------------------
| Customer Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/customer/login', [AuthController::class, 'showLoginForm']);
Route::post('/customer/login', [AuthController::class, 'login']);

Route::get('/customer/register', [AuthController::class, 'showRegisterForm']);
Route::post('/customer/register', [AuthController::class, 'register']);

Route::post('/customer/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Customer Protected Routes
|--------------------------------------------------------------------------
*/
Route::prefix('customer')
    ->middleware('auth:customer')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index']);
        Route::get('/catalog', [ProductController::class, 'browse']);
        Route::get('/catalog/{id}', [ProductController::class, 'details']);

    });
