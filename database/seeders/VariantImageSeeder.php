<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variant;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class VariantImageSeeder extends Seeder
{

    public function run(): void
    {
        Variant::all()
            ->each(
            /**
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
             * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
             */
                function(Variant $variant) {
                    $imageUrl = sprintf("http://dma.local/images/%s.png", $variant['colour']);
                    $variant->addMediaFromUrl($imageUrl)->toMediaCollection('default');
                }
            );
    }

}
