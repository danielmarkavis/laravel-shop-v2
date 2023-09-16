<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{

    public function run(): void
    {
        Product::all()
            ->each(
                function(Product $product) {
                    $variants = Variant::factory()
                        ->count(rand(1, 5))
                        ->create();

                    $product->variants()->saveMany($variants);
                }
            );
    }

}
