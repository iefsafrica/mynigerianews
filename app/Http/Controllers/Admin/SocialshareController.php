<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Socialshare;
use Illuminate\Http\Request;

class SocialshareController extends Controller
{
    public function maanSocialIndex()
    {
        $socials = Socialshare::paginate(10);
        return view('admin.pages.social.index',compact('socials'));
    }

    public function maanSocialStore(Request $request)
    {
        $request->validate([
            'url'=>'required',
            'icon_code'=>'required',
            'follower'=>'required' 
        ]);

        $socials            = new Socialshare();
        $socials->url       = $request->url;
        $socials->icon_code = $request->icon_code;
        $socials->follower    = $request->follower;
        $socials->save();
        $this->setSuccess('Inserted') ;
        return redirect()->route('admin.social.index');

    }
    public function maanSocialUpdate(Request $request,Socialshare $socialshare)
    {
        $request->validate([
            'url'=>'required',
            'icon_code'=>'required',
            'follower'=>'required'
        ]);

        $socialshare->url       = $request->url;
        $socialshare->icon_code = $request->icon_code;
        $socialshare->follower    = $request->follower;
        $socialshare->save();
        $this->setSuccess('Updated') ;
        return redirect()->route('admin.social.index');

    }

    public function maanSocialDestroy(Socialshare $socialshare)
    {

        $socialshare->delete();
        return redirect()->route('admin.social.index');
    }
}
