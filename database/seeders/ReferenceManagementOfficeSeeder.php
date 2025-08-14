<?php

namespace Database\Seeders;

use App\Models\MainOffice;
use App\Models\ReferenceManagementOffice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ReferenceManagementOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poolManagement = config('app.roles')[3];

        $mainOffice = MainOffice::query()->first();
        $user = User::query()->role($poolManagement)->get();
        $poolManagementUser = User::query()->role($poolManagement)->inRandomOrder()->first();
        ReferenceManagementOffice::factory(count($user))
        ->state(new Sequence([
            'user_id' => $poolManagementUser->id
        ]))
        ->create();
    }
}
