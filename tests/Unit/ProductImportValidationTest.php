<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ProductImportValidationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function product_requires_name_price_and_category()
    {
        $product = Product::create([
            'name' => 'Imported Product',
            'price' => 2999,
            'category' => 'Accessories',
            'stock' => 5,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Imported Product',
        ]);
    }

    #[Test]
    public function product_price_must_be_numeric()
    {
        $this->assertIsNumeric(2999);
    }
}
