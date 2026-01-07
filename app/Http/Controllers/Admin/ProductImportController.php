<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ProductImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.products.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx|max:204800',
        ]);

        Excel::queueImport(
            new ProductsImport,
            $request->file('file')
        );

        // IMPORTANT: redirect immediately (no wait)
        return redirect('/admin/products')
            ->with('success', 'Import started in background. Data will appear shortly.');
    }
}
