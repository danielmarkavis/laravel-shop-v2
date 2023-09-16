<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Variant>
 */
class AttributeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'colour',
            'description' => 'This is the colour attribute'
        ];
    }
}
