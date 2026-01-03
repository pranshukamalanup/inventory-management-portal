<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    protected function unauthenticated($request, array $guards): Response
    {
        if ($request->is('admin/*')) {
            return redirect('/admin/login');
        }

        if ($request->is('customer/*')) {
            return redirect('/customer/login');
        }

        return redirect('/');
    }
}
