<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (Auth::guard('admin')->check()) {
        return redirect('/admin/dashboard');
    }

    if (Auth::guard('customer')->check()) {
        return redirect('/customer/dashboard');
    }

    return view('home'); // landing page
});


/*
|--------------------------------------------------------------------------
| Mandatory login route (Laravel core requirement)
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect('/customer/login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Load role based routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/admin.php';
require __DIR__.'/customer.php';
