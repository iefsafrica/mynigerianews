<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Videogallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VideogalleryController extends Controller
{
    public function maanVideogalleryIndex()
    {
        $videogalleries = Videogallery::paginate(10);
        return view('admin.pages.media.video.index',compact('videogalleries'));
    }

    public function maanVideogalleryCreate()
    {
        return view('admin.pages.media.video.create');
    }

    public function maanVideoGalleryStore(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'video_option'=>'required',
            'image'=>'required',
        ]);
        if ($request->hasFile('video')){
            $request->validate([
                'video'=>'required|max:2048',
            ]);

            $videos            = 'maanvideogallery'.date('dmY_His').'_'.$request->video->getClientOriginalName();
            // video path
            $video_url          = 'public/uploads/videos/videogallery/' . $videos;
            //video base path
            $destinationPath    = base_path() . '/public/uploads/videos/videogallery/';
            $success            = $request->video->move($destinationPath, $videos);
            if ($success){
                $video_urls     = $video_url ;
            }
        }else{
            $video_urls         = '' ;
        }

        if ($request->video_option=='Share Link'){
            $video_urls =$request->share_link;
        }
        $videogalleries = new Videogallery();
        $videogalleries->title = $request->title;
        $videogalleries->description = $request->description;
        $videogalleries->video_option = $request->video_option;
        $videogalleries->video = $video_urls;
        if ($request->status){
            $videogalleries->status = 1;
        }else{
            $videogalleries->status = 0;
        }
        if ($request->video_source){
            $videogalleries->video_source =$request->video_source ;
        }else{
            $videogalleries->video_source ='Maantheme';
        }
        if ($request->image!='') {
            $videogalleries->image = imageUpload($request->file('image'),'public/uploads/videos/images/',null,trim(str_replace(' ', '_', strtolower($request->title))));
        }
        $videogalleries->user_id = Auth::user()->id ;
        $videogalleries->save();
        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.videogallery') ;

    }

    public function maanVideogalleryEdit(Videogallery $videogallery)
    {
        return view('admin.pages.media.video.edit',compact('videogallery'));
    }

    public function maanVideogalleryUpdate(Request $request, Videogallery $videogallery)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'video_option'=>'required',

        ]);
        if ($request->hasFile('video')) {
            $request->validate([
                'video' => 'required|max:2048',
            ]);
            if (File::exists($videogallery->video)){
                unlink($videogallery->video);
            }
            $videos            = 'maanvideogallery'.date('dmY_His').'_'.$request->video->getClientOriginalName();
            // video path
            $video_url          = 'public/uploads/videos/videogallery/' . $videos;
            //video base path
            $destinationPath    = base_path() . '/public/uploads/videos/videogallery/';
            $success            = $request->video->move($destinationPath, $videos);
            if ($success){
                $video_urls     = $video_url ;
            }
        }else{
            $video_urls     = $videogallery->video ;
        }
        if ($request->video_option=='Share Link'){
            $video_urls =$request->share_link;
        }

        $videogallery->title = $request->title;
        $videogallery->description = $request->description;
        $videogallery->video_option = $request->video_option;
        $videogallery->video = $video_urls;
        if ($request->status){
            $videogallery->status = 1;
        }else{
            $videogallery->status = 0;
        }
        if ($request->video_source){
            $videogallery->video_source =$request->video_source ;
        }else{
            $videogallery->video_source ='Maantheme';
        }
        if ($request->image!='') {
            $videogallery->image = imageUpload($request->file('image'),'public/uploads/videos/images/',$videogallery->image,trim(str_replace(' ', '_', strtolower($request->title))));
        }
        $videogallery->user_id = Auth::user()->id ;
        $videogallery->save();

        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.videogallery') ;
    }

    public function maanVideogalleryDestroy(Videogallery $videogallery)
    {
        if (File::exists($videogallery->video)){
            unlink($videogallery->video);
        }if (File::exists($videogallery->image)){
            unlink($videogallery->image);
        }
        $videogallery->delete();
        return redirect()->route('admin.videogallery');

    }
}
