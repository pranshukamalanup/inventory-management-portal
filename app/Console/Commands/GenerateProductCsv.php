<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateProductCsv extends Command
{
    protected $signature = 'products:generate-csv {rows=1000}';
    protected $description = 'Generate sample product CSV for bulk import testing';

    public function handle()
    {
        $rows = (int) $this->argument('rows');
        $path = storage_path('app/products_sample_import.csv');

        $handle = fopen($path, 'w');

        fputcsv($handle, [
            'name','description','price','category','stock','image'
        ]);

        $categories = ['Electronics','Computers','Accessories','Furniture','Fashion'];

        for ($i = 1; $i <= $rows; $i++) {
            fputcsv($handle, [
                "Product $i",
                "Sample description $i",
                rand(100, 50000),
                $categories[array_rand($categories)],
                rand(1, 500),
                ''
            ]);
        }

        fclose($handle);

        $this->info("CSV generated at: $path");
    }
}
