<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return new Product([
            'name'        => $row['name'],
            'description' => $row['description'] ?? null,
            'price'       => $row['price'],
            'category'    => $row['category'],
            'stock'       => $row['stock'],
            'image'       => $row['image'] ?: 'products/default.png',
        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // safe for big files
    }
}
