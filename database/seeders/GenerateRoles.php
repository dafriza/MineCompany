<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GenerateRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = config('app.roles');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
