<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Photogallery;
use App\Models\Socialshare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotogalleryController extends Controller
{
    public function maanPhotogalleryIndex()
    {
        $photogalleries = Photogallery::join('users','photogalleries.user_id','=','users.id')
            ->select('photogalleries.id','photogalleries.title','photogalleries.description','photogalleries.image','photogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('photogalleries.status',1)
            ->orderByDesc('photogalleries.id')
            ->paginate(10);
        $popularphotogalleries = Photogallery::where('status',1)
            ->orderByDesc('viewers')
            ->limit(4)
            ->get();
        $recentphotogalleries = Photogallery::where('status',1)
            ->orderByDesc('id')
            ->limit(5)
            ->get();


        return view('frontend.pages.photogallery',compact('photogalleries','popularphotogalleries','recentphotogalleries'));
    }

    public function maanPhotogalleryDetails($id)
    {
        $viewers = Photogallery::where('id',$id)->value('viewers');
        $data['viewers'] = $viewers +1 ;
        //update
        Photogallery::where('id',$id)->update($data) ;

        $photogallery = Photogallery::join('users','photogalleries.user_id','=','users.id')
            ->select('photogalleries.id','photogalleries.title','photogalleries.description','photogalleries.image','photogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('photogalleries.id',$id)
            ->where('photogalleries.status',1)
            ->first();
        //related news
        $relatedphotogallery = Photogallery::join('users','photogalleries.user_id','=','users.id')
            ->select('photogalleries.id','photogalleries.title','photogalleries.description','photogalleries.image','photogalleries.created_at',DB::raw("CONCAT(users.first_name,' ',users.last_name) AS reporter_name"))
            ->where('photogalleries.id','!=',$id)
            ->where('photogalleries.status',1)
            ->orderByDesc('photogalleries.id')
            ->limit(3)
            ->get();
        $socials = Socialshare::all();


        return view('frontend.pages.photogallery_details',compact('photogallery','relatedphotogallery','socials'));
    }
}
