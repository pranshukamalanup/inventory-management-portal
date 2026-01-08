<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPresence;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),

            'onlineAdmins' => UserPresence::where('user_type', 'admin')
                ->where('is_online', true)
                ->count(),

            'onlineCustomers' => UserPresence::where('user_type', 'customer')
                ->where('is_online', true)
                ->count(),
        ]);
    }
}
