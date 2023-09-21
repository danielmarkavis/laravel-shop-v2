<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{

    public function run(): void
    {
        Product::all()
            ->each(
                function(Product $product) {
                    $colours = ['blue','red','green','yellow','pink'];
                    shuffle($colours);
                    foreach($colours as $colour) {
                        $variants = Variant::factory([
                            'price' => $product->price,
                            'product_id' => $product->id,
                            'colour' => $colour,
                        ])
                            ->count(6)
                            ->sequence(
                                ['size'=>'xs'],
                                ['size'=>'sm'],
                                ['size'=>'md'],
                                ['size'=>'lg'],
                                ['size'=>'xl'],
                                ['size'=>'xxl']
                            )
                            ->create()
                            ->each(function($variant) {
                                $variant->stock = rand(0,2);
                            });
                        $product->variants()->saveMany($variants);
                    }
                }
            );
    }

}
