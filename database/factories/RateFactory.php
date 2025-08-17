<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rate_id' => 'RATE' . $this->faker->unique()->numerify('###'),
            'name'    => $this->faker->randomElement(['Standard Rate', 'Non-refundable', 'Breakfast Included']),
        ];
    }
}
