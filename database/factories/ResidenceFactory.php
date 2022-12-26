<?php

namespace Database\Factories;

use App\Models\{User, Role};

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ResidenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'label' => fake()->company(),  // Haven't find better faker formatter
			'street' => fake()->streetName(),
			'city' => fake()->city(),
			'zipcode' => fake()->postcode(),
			'lng' => fake()->longitude(),
			'lat' => fake()->latitude(),
			'surface' => fake()->numberBetween(10000, 10000),
			'monthly_price' => fake()->numberBetween(50000, 100000),
			'status' => fake()->randomElement(['rented', 'available']),
        ];
    }
}
