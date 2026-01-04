<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (NO auth middleware)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm']);
Route::post('/admin/register', [AdminAuthController::class, 'register']);

Route::post('/admin/logout', [AdminAuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware('auth:admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    });
