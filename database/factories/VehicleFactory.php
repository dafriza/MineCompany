<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Honda', 'Yamaha', 'Wuling']) . '-' . fake()->bothify('?????-#####'),
            'type' => fake()->randomElement(['Manual', 'Matic']),
            'gasoline_fuel' => fake()->randomNumber(2, true),
            'maintain_schedule' => fake()->dateTimeBetween('+1 week', '+1 years'),
            'release' => fake()->dateTimeBetween('+1 week', '+1 years'),
        ];
    }
}
