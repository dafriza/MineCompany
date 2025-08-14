<?php

namespace Database\Factories;

use App\Models\VehicleOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleOrder>
 */
class VehicleOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = VehicleOrder::class;

    public function definition(): array
    {
        return [
            'order_id' => fake()->lexify('id-????'),
            'start' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'end' => fake()->dateTimeBetween('+2 week', '+3 week'),
            'status' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
        ];
    }
}
