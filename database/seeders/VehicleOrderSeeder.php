<?php

namespace Database\Seeders;

use App\Models\VehicleOrder;
use App\Models\VehicleOwner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class VehicleOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleOwner = VehicleOwner::query()->inRandomOrder()->first();
        $vehicleOrder = VehicleOrder::factory(100)
        ->state(new Sequence([
            'vehicle_owner_id' => $vehicleOwner->id
        ]))
        // ->for($vehicleOwner, 'vehicleOwner')
        ->create();
    }
}
