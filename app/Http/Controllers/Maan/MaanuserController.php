<?php

namespace App\Http\Controllers\Maan;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Maanuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaanuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Maanuser::where('id',Auth::guard('maanuser')->user()->id)->first();
        return view('maanuser.pages.profile',compact('profile'));
    }

    /**
     * Display course .
     *
     * @return \Illuminate\Http\Response
     */
    public function maanUserReporter()
    {
        $reporters = User::where('user_type','0')->paginate(10);
        return view('maanuser.pages.reporters.reporter',compact('reporters'));
    }

    /**
     * Display post .
     *
     * @return \Illuminate\Http\Response
     */
    public function maanUserPost()
    {
        $postall = Blog::paginate(10);
        return view('maanuser.pages.blogs.post',compact('postall'));
    }

}
