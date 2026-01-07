<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function browse(Request $request)
    {
        // Unique categories from products table
        $categories = Product::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        // Filter products if category selected
        $products = Product::when($request->category, function ($query) use ($request) {
            $query->where('category', $request->category);
        })
        ->latest()
        ->paginate(12)
        ->withQueryString(); // keeps filter on pagination

        return view('customer.dashboard', compact('products', 'categories'));
    }

    public function details($id)
    {
        $product = Product::findOrFail($id);

        return view('customer.catalog.details', compact('product'));
    }
}
