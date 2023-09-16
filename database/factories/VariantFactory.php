<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class VariantFactory extends Factory
{
//    private static int $order = 0;
//    private static array $colors = ['green', 'blue', 'red', 'yellow', 'pink'];
//    private static array $sizeArray = ['xs','sm','md','lg','xl','xxl'];


    public function definition(): array
    {
//        if (self::$order >= 5) self::$order = 0;

        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'sku' => 'VAR'.str_pad(rand(1,999999), 8, '0', STR_PAD_LEFT),
//            'colour' => self::$colors[self::$order++],
//            'size' => self::$sizeArray[array_rand(self::$sizeArray, 1)],
            'price' => rand(10,99),
            'stock' => rand(1,99),
        ];
    }
}
