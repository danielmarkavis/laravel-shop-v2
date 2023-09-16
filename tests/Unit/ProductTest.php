<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_create(): void
    {
        $product = Product::factory()->create();

        $this->assertModelExists($product);
    }

    public function test_product_updates(): void
    {
        $product = Product::factory()->create();

        $product->update(['name'=> 'Mad Hatter']);

        $this->assertDatabaseHas('products', [
            'name' => 'Mad Hatter',
        ]);
    }

    public function test_product_delete(): void
    {
        $product = Product::factory()->create();

        $this->assertModelExists($product);

        $product->delete();

        $this->assertModelMissing($product);
    }

    public function test_products_count_is_2(): void
    {
        Product::factory(['name' => 'Product 1'])->create();
        Product::factory(['name' => 'Product 2'])->create();

        $this->assertDatabaseCount('products', 2);
    }

}
