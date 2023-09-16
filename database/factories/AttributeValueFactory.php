<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class AttributeValueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'value' => 'green',
            'description' => 'This is the green colour'
        ];
    }
}
