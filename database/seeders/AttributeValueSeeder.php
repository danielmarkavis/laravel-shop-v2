<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{

    public function run(): void
    {
        Attribute::all()
            ->each(
            /**
             * @throws \Exception
             */
                function(Attribute $attribute) {
                    $attributeValues = match ($attribute->name) {
                        'size' => AttributeValue::factory()
                            ->state(
                                new Sequence(
                                    ['value' => 'xs', 'label' => 'XS', 'description' => 'This is extra small', 'sequence' => 1],
                                    ['value' => 'sm', 'label' => 'SM', 'description' => 'This is small', 'sequence' => 2],
                                    ['value' => 'md', 'label' => 'MD', 'description' => 'This is medium', 'sequence' => 3],
                                    ['value' => 'lg', 'label' => 'LG', 'description' => 'This is large', 'sequence' => 4],
                                    ['value' => 'xl', 'label' => 'XL', 'description' => 'This is extra large', 'sequence' => 5],
                                    ['value' => 'xxl', 'label' => 'XXL', 'description' => 'This is extra extra large', 'sequence' => 6],
                                )
                            )
                            ->count(6)
                            ->create(['attribute_id' => $attribute->id]),
                        'colour' => AttributeValue::factory()
                            ->state(
                                new Sequence(
                                    ['value' => 'green', 'label' => 'Green', 'description' => 'This is green', 'sequence' => 1],
                                    ['value' => 'blue', 'label' => 'Blue', 'description' => 'This is blue', 'sequence' => 1],
                                    ['value' => 'red', 'label' => 'Red', 'description' => 'This is red', 'sequence' => 1],
                                    ['value' => 'yellow', 'label' => 'Yellow', 'description' => 'This is yellow', 'sequence' => 1],
                                    ['value' => 'pink', 'label' => 'Pink', 'description' => 'This is pink', 'sequence' => 1],
                                )
                            )
                            ->count(5)
                            ->create(['attribute_id' => $attribute->id]),
                        default => throw new \Exception('Attribute name not found: ' . $attribute->name),
                    };

                    $attribute->attributeValues()->saveMany($attributeValues);
                }
            );
    }

}