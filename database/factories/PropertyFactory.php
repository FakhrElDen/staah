<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
            'property_id'   => (string) $this->faker->unique()->numerify('PROP###'),
            'name'          => $this->faker->company . ' Hotel',
            'api_key'       => Str::uuid(),
            'currency'      => $this->faker->randomElement(['USD', 'INR', 'EUR']),
        ];
    }
}
