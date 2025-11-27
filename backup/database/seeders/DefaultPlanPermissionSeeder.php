<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultPlanPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'name' => 'manage_plans',
            'display_name' => 'Manage Plans',
        ];
        $permission = Permission::create($permissions);

        /** @var Role $adminRole */
        $adminRole = Role::whereName('admin')->first();

        if (isset($adminRole)) {
            $staffPermission = Permission::whereIn('name', ['manage_plans'])->pluck('name', 'id');
            $adminRole->givePermissionTo($staffPermission);
        }

    }
}
