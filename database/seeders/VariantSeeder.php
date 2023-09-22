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
                    $colours = ['gray','blue','green','red','yellow'];
                    shuffle($colours);
                    $colours = array_slice($colours, 0, rand(1,5));

                    foreach($colours as $colour) {
                        $variants = Variant::factory([
                            'price' => $product->price,
                            'sale_price' => $product->sale_price,
                            'product_id' => $product->id,
                            'colour' => $colour,
                        ])
                            ->count(6)
                            ->sequence(
                                ['size'=>'XS'],
                                ['size'=>'SM'],
                                ['size'=>'MD'],
                                ['size'=>'LG'],
                                ['size'=>'XL'],
                                ['size'=>'XXL']
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
