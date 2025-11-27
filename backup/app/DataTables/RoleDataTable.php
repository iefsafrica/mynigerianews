<?php

namespace App\DataTables;

use App\Models\Role;

/**
 * Class RoleDataTable
 */
class RoleDataTable
{
    public function get(): Role
    {
        /** @var Role $query */
        $query = Role::with('permissions')->select('roles.*');

        return $query;
    }
}
