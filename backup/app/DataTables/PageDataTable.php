<?php

namespace App\DataTables;

use App\Models\Page;

/**
 * Class PageDataTable
 */
class PageDataTable
{
    public function get(): Page
    {
        /** @var Page $query */
        $query = Page::with('language')->get();

        return $query;
    }
}
