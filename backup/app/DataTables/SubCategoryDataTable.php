<?php

namespace App\DataTables;

use App\Models\SubCategory;

/**
 * Class SubCategoryDataTable
 */
class SubCategoryDataTable
{
    public function get(): SubCategory
    {
        /** @var SubCategory $query */
        $query = SubCategory::with('language', 'category')->get();

        return $query;
    }
}
