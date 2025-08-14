<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SyncRolesAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesConfig = config('app.roles');
        $administrator = $rolesConfig[0];
        $manager = $rolesConfig[1];
        $supervisor = $rolesConfig[2];
        $poolManagement = $rolesConfig[3];
        $driver = $rolesConfig[4];

        $permissionsConfig = config('app.permissions');
        $administratorPermissions = [
            $permissionsConfig[0],
            $permissionsConfig[1],
            $permissionsConfig[3],
            $permissionsConfig[5],
            $permissionsConfig[6],
        ];
        
        $managerPermissions = [
            $permissionsConfig[2],
            $permissionsConfig[5],
            $permissionsConfig[6],
        ];
        
        $supervisorPermissions = [
            $permissionsConfig[2],
            $permissionsConfig[5],
            $permissionsConfig[6],
        ];
        
        $poolManagementPermissions = [
            $permissionsConfig[3],
            $permissionsConfig[5],
            $permissionsConfig[6],
        ];
        
        $driverPermissions = [
            $permissionsConfig[4],
            $permissionsConfig[6],
        ];

        $administratorModel = $this->getRoleByName($administrator);
        $managerModel = $this->getRoleByName($manager);
        $supervisorModel = $this->getRoleByName($supervisor);
        $poolManagementModel = $this->getRoleByName($poolManagement);
        $driverModel = $this->getRoleByName($driver);

        $administratorModel->syncPermissions(
            $this->getPermissionsByName($administratorPermissions)
        );
        
        $managerModel->syncPermissions(
            $this->getPermissionsByName($managerPermissions)
        );
        
        $supervisorModel->syncPermissions(
            $this->getPermissionsByName($supervisorPermissions)
        );
        
        $poolManagementModel->syncPermissions(
            $this->getPermissionsByName($poolManagementPermissions)
        );
        
        $driverModel->syncPermissions(
            $this->getPermissionsByName($driverPermissions)
        );
    }

    public function getRoleByName(string $name) : Role {
        $role = Role::query()->where('name', 'like', $name)->first();
        return $role;
    }

    public function getPermissionsByName(array $names) : array {
        $setOfPermission = [];
        foreach ($names as $name) {
            $permissions = Permission::query()->where('name', 'LIKE', '%'.$name.'%')->get();
            $setOfPermission = array_merge($setOfPermission, $permissions->toArray());
        }

        $setOfPermission = array_map(function($permission) {
            return $permission['name'];
        }, $setOfPermission);

        return $setOfPermission;
    }
}
