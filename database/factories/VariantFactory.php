<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class VariantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'sku' => 'VAR'.str_pad(rand(1,999999), 8, '0', STR_PAD_LEFT),
            'price' => rand(10,99),
            'stock' => rand(1,99),

            'colour' => 'green',
            'size' => 'xs'
        ];
    }
}
