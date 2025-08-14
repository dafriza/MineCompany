<?php

namespace Database\Seeders;

use App\Models\BranchOffice;
use App\Models\Mine;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supervisor = config('app.roles')[2];

        $province = Province::query()->first();
        $regency = $province->regencies->first();
        $district = $regency->districts->first();
        $village = $district->villages->first();

        $user = User::query()->role($supervisor)->first();
        $branchOffice = BranchOffice::query()->first();

        $mine = Mine::factory()
        ->for($province, 'province')
        ->for($regency, 'regency')
        ->for($district, 'district')
        ->for($village, 'village')
        ->for($user, 'supervisor')
        ->for($branchOffice, 'branchOffice')
        ->create();
    }
}
