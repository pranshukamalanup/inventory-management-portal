<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Storage;

class ProductsImport implements
    ToModel,
    WithHeadingRow,
    WithChunkReading,
    ShouldQueue
{
    public function model(array $row)
    {
        return new Product([
            'name'        => $row['name'] ?? '',
            'description' => $row['description'] ?? null,
            'price'       => $row['price'] ?? 0,
            'category'    => $row['category'] ?? 'General',
            'stock'       => $row['stock'] ?? 0,
            'image'       => $row['image'] && Storage::disk('public')->exists($row['image'])
                                ? $row['image']
                                : 'products/default.png',
        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // safe for 100k rows
    }
}
