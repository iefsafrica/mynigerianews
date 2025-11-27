<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maanuser;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Maanuser::paginate(10);
        return view('admin.pages.subscribers.index',compact('subscribers'));
    }

    public function destroy($id)
    {
        Maanuser::destroy($id);
        return redirect()->back();
    }
}
