<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Variant;
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
//                    $variant->load(['attributeValues.attribute']);
//                    dd($variant);
//                    $colourId = Attribute::where('name', 'colour')->first()->id;
//                    dd($colourId, $variant->attributeValues[$colourId-1]->value);
//                    dd(collect($variant->attributeValues)->pluck('value')->toArray());
//                    $colour = $variant->attributeValues[$colourId-1]->value;
//                    dd($variant);
//                    dd($variant->attributeValues()->attributeOnly('colour')->first()->value);
//                    $colour = $variant->attributeValues()->attributeOnly('colour')->first()->value;

                    $imageUrl = sprintf("http://dma.local/images/%s.jpg", $variant->colour);
                    $variant->addMediaFromUrl($imageUrl)->toMediaCollection('default');
                }
            );
    }

}
