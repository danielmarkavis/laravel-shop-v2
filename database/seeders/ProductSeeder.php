<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        Product::factory()
            ->count(25)
//            ->state([])
            ->create()
        ->each(function(Product $product) {
            if (rand(1,5) === 3) {
                $product->sale_price = $product->price * 0.5;
                $product->save();
            }
        });
    }

}