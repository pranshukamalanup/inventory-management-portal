<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImportController;


Route::get('/admin/login', [AuthController::class, 'showLoginForm']);
Route::post('/admin/login', [AuthController::class, 'login']);

Route::get('/admin/register', [AuthController::class, 'showRegisterForm']);
Route::post('/admin/register', [AuthController::class, 'register']);

Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/products', [ProductController::class, 'index']);

    Route::get('/products/create', [ProductController::class, 'create']);
    Route::post('/products', [ProductController::class, 'store']);

    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{id}', [ProductController::class, 'update']);

    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::get('/products/import', [ProductImportController::class, 'showImportForm']);
    Route::post('/products/import', [ProductImportController::class, 'import']);

});
