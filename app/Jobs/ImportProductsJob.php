<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(): void
    {
        $fullPath = storage_path('app/' . $this->filePath);

        if (!file_exists($fullPath)) {
            return;
        }

        $handle = fopen($fullPath, 'r');

        // Skip header
        fgetcsv($handle);

        $batch = [];

        while (($row = fgetcsv($handle)) !== false) {

            $batch[] = [
                'name'        => $row[0] ?? '',
                'description' => $row[1] ?? null,
                'price'       => (float) ($row[2] ?? 0),
                'category'    => $row[3] ?? 'General',
                'stock'       => (int) ($row[4] ?? 0),
                'image'       => $row[5] ?? 'products/default.png',
                'created_at'  => now(),
                'updated_at'  => now(),
            ];

            if (count($batch) === 500) {
                Product::insert($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            Product::insert($batch);
        }

        fclose($handle);

        // Optional: delete file after import
        // unlink($fullPath);
    }
}
