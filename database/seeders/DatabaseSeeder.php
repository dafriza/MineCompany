<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // GenerateIndonesiaRegion::class,
            
            GenerateRoles::class,
            GeneratePermission::class,
            SyncRolesAndPermission::class,
            UserSeeder::class,
            
            CompanySeeder::class,
            MainOfficeSeeder::class,
            BranchOfficeSeeder::class,
            MineSeeder::class,

            VehicleSeeder::class,
            VehicleCompanySeeder::class,
            VehicleOwnerSeeder::class,
            VehicleOrderSeeder::class,
            VehicleUsageSeeder::class
        ]);
    }
}
