<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleCompany::factory(5)->create();
    }
}
