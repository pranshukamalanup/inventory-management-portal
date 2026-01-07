<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ImportProductsJob;

class ProductImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.products.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv|max:204800', // 200MB
        ]);

        // Permanently store file
        $path = $request->file('file')->storeAs(
            'imports',
            time().'_'.$request->file('file')->getClientOriginalName()
        );

        // Dispatch background job
        ImportProductsJob::dispatch($path);

        return redirect('/admin/products')
            ->with('success', 'Import started in background. Data will appear shortly.');
    }
}
