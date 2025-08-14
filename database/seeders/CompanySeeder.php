<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\ReferenceManagementOffice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = config('app.roles')[0];

        $user = User::query()->role($administrator)->first();
        $company = Company::factory()
        ->for($user, 'user')
        ->create();
    }
}
