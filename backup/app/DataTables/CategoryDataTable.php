<?php

namespace App\DataTables;

use App\Models\Category;

/**
 * Class CategoryDataTable
 */
class CategoryDataTable
{
    public function get(): Category
    {
        /** @var Category $query */
        $query = Category::with('language')->get();

        return $query;
    }
}
