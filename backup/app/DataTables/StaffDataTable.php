<?php

namespace App\DataTables;

use App\Models\Staff;
use App\Models\User;

/**
 * Class StaffDataTable
 */
class StaffDataTable
{
    public function get(): Staff
    {
        /** @var Staff $query */
        $query = User::where('type', User::STAFF)->get();

        return $query;
    }
}
