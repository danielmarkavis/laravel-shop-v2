<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variant;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    protected mixed $faker;

    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    public function run(): void
    {
        $colors = ['green','blue','red,','yellow','pink'];

        Product::factory()
            ->count(25)
            ->hasVariants(rand(2, 4))
            ->create()
            ->each(
            /**
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
             */
            function(Product $product) {
                foreach ($product->variants as $index => $variant) {
                    $imageUrl = sprintf("http://dma.local/images/%s.png", $variant['colour']);
                    $variant->addMediaFromUrl($imageUrl)->toMediaCollection('default');
                }

                $imageUrl = $product->variants[0]->image->url;
                $product->addMediaFromUrl($imageUrl)->toMediaCollection('default');
            });
    }

}