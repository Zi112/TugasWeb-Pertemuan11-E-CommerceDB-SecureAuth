<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'sku'         => strtoupper(fake()->unique()->bothify('SKU-????-####')),
            'name'        => Str::title($name),
            'slug'        => Str::slug($name),
            'description' => fake()->paragraph(3),
            'image'       => 'https://picsum.photos/seed/' . Str::slug($name) . '/600/450',
            'price'       => fake()->numberBetween(10, 3000) * 1000,
            'stock'       => fake()->numberBetween(0, 200),
            'is_active'   => fake()->boolean(92),
        ];
    }
}
