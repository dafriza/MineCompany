<?php

namespace Database\Factories;

use App\Models\VehicleCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleCompany>
 */
class VehicleCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = VehicleCompany::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'telephone' => fake()->e164PhoneNumber(),
            'address' => fake()->address()
        ];
    }
}
