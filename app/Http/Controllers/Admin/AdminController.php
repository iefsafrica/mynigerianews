<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maanuser;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the Dashboard.
     *
     */

    public function maanDashboard()
    {
        if (Auth::user()->user_type>1){
            $admin = User::where('user_type','>=','3')->where('is_active','1')->count();
            $publish_news = News::where('status',1)->count();
            $unpublish_news = News::where('status',0)->count();
            $subscribe = Maanuser::count();

            return view('admin.pages.dashboard',compact('admin','publish_news','unpublish_news','subscribe')) ;

        }else{
            return view('admin.pages.dashboard2') ;
        }

    }
}
