<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Variant;
use Illuminate\Database\Seeder;

class AttributeValueVariantSeeder extends Seeder
{
    protected int $order = 0;

//    protected array $colors = ['red', 'blue', 'green', 'yellow', 'pink'];
    protected array $sizes = ['xs', 'sm', 'md', 'lg', 'xl','xxl'];

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
                        // Todo: Add multiple sizes to colours
                        $attributeValue = match ($attribute->name) {
                            'size' => AttributeValue::attributeOnly('size')->where('value',$this->sizes[$this->order])->first(),//inRandomOrder()->first(),
                            default => AttributeValue::attributeOnly('colour')->first(),
                        };
                        $variant->attributeValues()->attach($attributeValue);

                        if ($attribute->name === 'size') {
                            $this->order++;
                        }
                    });

                //                $colour = AttributeValue::attributeOnly('colour')->inRandomOrder()->first();
                //                $variant->attributeValues()->attach($colour);

            }
        );
    }

}