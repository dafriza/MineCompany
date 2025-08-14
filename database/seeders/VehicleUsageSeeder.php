<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VehicleOrder;
use App\Models\VehicleOwner;
use App\Models\VehicleUsage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class VehicleUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleOwner = VehicleOwner::query()->inRandomOrder()->first();
        
        $user = User::query()->inRandomOrder()->first();
        $vehicleOrder = VehicleOrder::query()->inRandomOrder()->first();

        $groupOfMaintain = [
            $user,
            $vehicleOrder
        ];
        $selectedMaintain = $groupOfMaintain[array_rand($groupOfMaintain)];

        VehicleUsage::factory(100)
        // ->for($vehicleOwner, 'vehicleOwner')
        ->state(new Sequence([
            'vehicle_owner_id' => $vehicleOwner->id
        ]))
        ->state(new Sequence(
            [
                'maintainable_type' => get_class($user),
                'maintainable_id' => $user->id
            ],
            [
                'maintainable_type' => get_class($vehicleOrder),
                'maintainable_id' => $vehicleOrder->id
            ],
        ))
        ->state(new Sequence([
            'value' => fake()->randomNumber(2)
        ]))
        // ->for($selectedMaintain, 'maintainable')
        ->create();
    }
}
