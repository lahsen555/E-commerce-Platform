<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name(),
            "price" => $this->faker->numberBetween(10, 200),
            "origin" => $this->faker->randomElement([
                "Agadir",
                "Casa",
                "Tanga",
                "Tmanar",
                "Imgrad"
            ]) 
        ];
    }
}

