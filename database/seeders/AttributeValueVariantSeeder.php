<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class AttributeValueVariantSeeder extends Seeder
{

    public function run(): void
    {
        $variants = Variant::all();

        $attributes = Attribute::all();

        $variants // Assign each variant with each attribute
            ->each(
                function(Variant $variant) use ($attributes) {
                    $attributes
                        ->each(function($attribute) use ($variant) {
                            // Grab a single attributeValue that matches the attribute type.
                            $attributeValue = match ($attribute->name) {
                                'size' => AttributeValue::attributeOnly('size')->inRandomOrder()->first(),
                                default => AttributeValue::attributeOnly('colour')->inRandomOrder()->first(),
                            };
                            $variant->attributeValues()->attach($attributeValue);
                        });
                }
            );
    }

}