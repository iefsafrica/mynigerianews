<?php

namespace App\DataTables;

use App\Models\Poll;

/**
 * Class PollDataTable
 */
class PollDataTable
{
    public function get(): Poll
    {
        /** @var Poll $query */
        $query = Poll::with('language')->get();

        return $query;
    }
}
