<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PostTableController extends Controller
{
    public function tableData(): View
    {
        return view('post.table');
    }
}
