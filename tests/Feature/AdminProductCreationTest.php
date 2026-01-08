<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;

class AdminProductCreationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_create_a_product()
    {
        $admin = Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($admin, 'admin');

        $response = $this->post('/admin/products', [
            'name'        => 'Test Product',
            'description' => 'Test Description',
            'price'       => 1999,
            'category'    => 'Electronics',
            'stock'       => 10,
        ]);

        $response->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 1999,
        ]);
    }
}
