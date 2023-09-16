<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        Attribute::factory()
            ->create(['name' => 'size', 'description' => 'This is the size attribute']);
        Attribute::factory()
            ->create(['name' => 'colour', 'description' => 'This is the colour attribute']);
    }

}