<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\MainOffice;
use App\Models\ReferenceManagementOffice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = config('app.roles')[0];
        $poolManagement = config('app.roles')[3];

        $user = User::query()->role($administrator)->first();
        $company = Company::query()->first();

        $mainOffice = MainOffice::factory()
        ->for($user, 'administrator')
        ->for($company, 'company')
        ->create();

        // $poolManagementUser = User::query()->role($poolManagement)->first();
        // $referenceManagementOffice = new ReferenceManagementOffice([
        //     'user_id' => $poolManagementUser->id
        // ]);

        // $mainOffice->referManagement()->save($referenceManagementOffice);
    }
}
