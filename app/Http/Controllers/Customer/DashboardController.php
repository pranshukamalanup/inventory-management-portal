<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Categories (dynamic, no hardcode)
        $categories = Product::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        // Products with optional category filter
        $products = Product::when($request->category, function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('customer.dashboard', compact('products', 'categories'));
    }
}
