<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape([
        'name'     => "string", 'slug' => "string", 'featured' => "false", 'details' => "string",
        'price'    => "int", 'description' => "string", 'image' => "string", 'images' => "string",
        'quantity' => "int",
    ])] public function definition(): array
    {
        return [
            'name'        => $this->faker->sentence(5),
            'slug'        => $this->faker->slug,
            'featured'    => false,
            'details'     => $this->faker->sentence(8),
            'price'       => $this->faker->numberBetween(2000000, 15000000),
            'description' => $this->faker->paragraph,
            'image'       => 'products/dummy/laptop-1.jpeg',
            'images'      => '["products\/dummy\/laptop-2.jpeg", "products\/dummy\/laptop-3.jpeg", "products\/dummy\/laptop-4.jpeg"]',
            'quantity'    => 10,
        ];
    }
}
