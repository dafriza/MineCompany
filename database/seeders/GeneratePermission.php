<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class GeneratePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = config('app.permissions');
        $modifierAccess = ['create', 'read', 'update', 'delete'];
        $groupOfPermissions = [];
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        foreach ($permissions as $permission) {
            foreach ($modifierAccess as $access) {
                array_push($groupOfPermissions, $access . '_' . $permission);
            }
        }

        foreach ($groupOfPermissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
    }
}
