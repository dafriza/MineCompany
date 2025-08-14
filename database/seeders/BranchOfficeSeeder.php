<?php

namespace Database\Seeders;

use App\Models\BranchOffice;
use App\Models\Company;
use App\Models\MainOffice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = config('app.roles')[1];

        $user = User::query()->role($manager)->first();
        $mainOffice = MainOffice::query()->first();

        $mainOffice = BranchOffice::factory()
        ->for($user, 'manager')
        ->for($mainOffice, 'mainOffice')
        ->create();
    }
}
