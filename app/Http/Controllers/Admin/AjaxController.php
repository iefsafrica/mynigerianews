<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Company;
use App\Models\Footer;
use App\Models\Header;
use App\Models\Menu;
use App\Models\News;
use App\Models\Newscategory;
use App\Models\Photogallery;
use App\Models\Settings;
use App\Models\Videogallery;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function maanPublishStatus(Request $request)
    {

        if ($request->ajax()){

            $statusLastText = explode(" ", $request->statustext);

            if ($request->statustext=='Blog'){
                Blog::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='Video'){
                Videogallery::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='Photo'){
                Photogallery::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='News'){
                News::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='Breaking News'){
                News::where('id',$request->id)->update(['breaking_news'=>$request->status]);
            }
            if ($request->statustext=='Contact Us'){
                Company::where('id',$request->id)->update(['status'=>$request->status]);
            }
            if ($request->statustext=='News Category'){
                Newscategory::where('id',$request->id)->update(['menu_publish'=>$request->status]);

            }
            if ($request->statustext=='Footer Status'){
                Footer::where('id',$request->id)->update(['status'=>$request->status]);

            }
            if ($request->statustext=='Menu'){
                Menu::where('id',$request->id)->update(['status'=>$request->status]);

            }
            if ($request->statustext=='Header'){
                Header::where('id',$request->id)->update(['status'=>$request->status]);

            }
            //is active ..
            if ( in_array('Active', $statusLastText)) {
                switch (current($statusLastText)){
                    case current($statusLastText):
                        $test = 'App\Models\\'.current($statusLastText);
                        $test::where('id','<>',$request->id)->update(['is_active'=>0]);
                    //return $test;
                        break ;
                }
                $test::where('id',$request->id)->update(['is_active'=>$request->status]);
               // return $request;
            }


            return $request;
        }
    }

    public function maanPublishThemeColor(Request $request)
    {
        if ($request->ajax()){
            $settings = Settings::latest('id')->first();
            Settings::where('id',$settings->id)->update(['theme_color'=>$request->theme_color]);
        }
        return $request;
    }
}
