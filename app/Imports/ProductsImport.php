<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ImportBatch;
use App\Models\ImportFailure;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\{
    ToModel,
    WithHeadingRow,
    WithChunkReading,
    WithEvents
};
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\AfterImport;

class ProductsImport implements
    ToModel,
    WithHeadingRow,
    WithChunkReading,
    ShouldQueue,
    WithEvents
{
    protected int $batchId;

    public function __construct(int $batchId)
    {
        $this->batchId = $batchId;
    }

    public function model(array $row)
    {
        try {
            $product = Product::where('name', $row['name'])
                ->where('category', $row['category'])
                ->first();

            if ($product) {
                // DUPLICATE → UPDATE
                $product->update([
                    'price' => $row['price'],
                    'stock' => $product->stock + ($row['stock'] ?? 0),
                ]);
            } else {
                Product::create([
                    'name'        => $row['name'],
                    'description' => $row['description'] ?? null,
                    'price'       => $row['price'],
                    'category'    => $row['category'],
                    'stock'       => $row['stock'],
                    'image'       => $row['image'] && Storage::disk('public')->exists($row['image'])
                        ? $row['image']
                        : 'products/default.png',
                ]);
            }

            ImportBatch::where('id', $this->batchId)
                ->increment('processed_rows');
        } catch (\Throwable $e) {

            ImportFailure::create([
                'import_batch_id' => $this->batchId,
                'row_data' => $row,
                'error' => $e->getMessage(),
            ]);

            ImportBatch::where('id', $this->batchId)
                ->increment('failed_rows');
        }

        return null;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function () {
                ImportBatch::where('id', $this->batchId)
                    ->update(['status' => 'processing']);
            },
            AfterImport::class => function () {
                ImportBatch::where('id', $this->batchId)
                    ->update(['status' => 'done']);
            },
        ];
    }
}
