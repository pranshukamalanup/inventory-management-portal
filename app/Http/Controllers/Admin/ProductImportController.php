<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Models\ImportBatch;

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

        $batch = ImportBatch::create([
            'status' => 'pending',
        ]);

        Excel::queueImport(
            new ProductsImport($batch->id),
            $request->file('file')
        );

        return redirect('/admin/products')
            ->with('success', 'Import started in background.');
    }

}
