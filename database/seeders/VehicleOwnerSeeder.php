<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleCompany;
use App\Models\VehicleOwner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class VehicleOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->role('driver')->inRandomOrder()->first();
        $vehicle = Vehicle::query()->inRandomOrder()->first();
        
        $company = Company::query()->first();
        $vehicleCompany = VehicleCompany::query()->inRandomOrder()->first();
        $groupOfCompanies = [$company, $vehicleCompany];

        $selectedCompany = $groupOfCompanies[array_rand($groupOfCompanies)];

        $vehicleOwner = VehicleOwner::factory(100)
        // ->for($user, 'driver')
        // ->for($vehicle, 'vehicle')
        ->state(new Sequence([
            'user_id' => $user->id
        ]))
        ->state(new Sequence([
            'vehicle_id' => $vehicle->id
        ]))
        ->state(new Sequence(
            [
                'ownerable_type' => get_class($company),
                'ownerable_id' => $company->id
            ],
            [
                'ownerable_type' => get_class($vehicleCompany),
                'ownerable_id' => $vehicleCompany->id
            ],
        ))
        // ->for($selectedCompany, 'ownerable')
        ->create();
    }
}
