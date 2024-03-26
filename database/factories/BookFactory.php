<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'author' => fake()->name(),
            'copies_available' => fake()->numberBetween(0,10),
            'pages' => fake()->numberBetween(100,300),
            'description' => fake()->text(100),
            'publication_year' => fake()->numberBetween(1900,2024),
        ];
    }
}
