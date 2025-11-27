<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmojiPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'name' => 'manage_emoji',
            'display_name' => 'Manage Emoji',
        ];
        $permission = Permission::whereIn('name', ['manage_emoji'])->get();
        if (empty($permission)) {
            $permission = Permission::create($permissions);
        }

        /** @var Role $adminRole */
        $adminRole = Role::whereName('admin')->first();

        if (isset($adminRole)) {
            $adminPermission = Permission::whereIn('name', ['manage_emoji'])->pluck('name', 'id');
            $adminRole->givePermissionTo($adminPermission);
        }

    }
}
