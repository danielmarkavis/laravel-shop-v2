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
                                    ['value' => 'xs', 'description' => 'This is extra small'],
                                    ['value' => 'sm', 'description' => 'This is small'],
                                    ['value' => 'md', 'description' => 'This is medium'],
                                    ['value' => 'lg', 'description' => 'This is large'],
                                    ['value' => 'xl', 'description' => 'This is extra large'],
                                    ['value' => 'xxl', 'description' => 'This is extra extra large'],
                                )
                            )
                            ->count(6)
                            ->create(['attribute_id' => $attribute->id]),
                        'colour' => AttributeValue::factory()
                            ->state(
                                new Sequence(
                                    ['value' => 'green', 'description' => 'This is green'],
                                    ['value' => 'blue', 'description' => 'This is blue'],
                                    ['value' => 'red', 'description' => 'This is red'],
                                    ['value' => 'yellow', 'description' => 'This is yellow'],
                                    ['value' => 'pink', 'description' => 'This is pink'],
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