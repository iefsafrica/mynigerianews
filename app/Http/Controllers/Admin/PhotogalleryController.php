<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photogallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PhotogalleryController extends Controller
{
    public function maanPhotogalleryIndex()
    {
        $photogalleries = Photogallery::paginate(10);
        return view('admin.pages.media.photo.index',compact('photogalleries'));
    }

    public function maanPhotogalleryStore(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'image'=>'required'
        ]);
        if ($request->hasFile('image')){

            foreach ($request->image as $image){

                if ($image !=''){
                    $picture            = 'maanphotogallery'.date('dmY_His').'_'.$image->getClientOriginalName();
                    // image path
                    $image_url          = 'public/uploads/images/photogallery/' . $picture;
                    //image base path
                    $destinationPath    = base_path() . '/public/uploads/images/photogallery/';
                    $success            = $image->move($destinationPath, $picture);
                    if ($success){
                        $image_urls     = $image_url ;
                    }
                }else{
                    $image_urls         = '' ;
                }
                $photogalleries                 = new Photogallery();
                $photogalleries->title          = $request->title;
                $photogalleries->description    = $request->description;
                if ($request->status){
                    $photogalleries->status     = 1 ;
                }else{
                    $photogalleries->status     = 0 ;
                }
                $photogalleries->image          = $image_urls;
                $photogalleries->user_id          = Auth::user()->id;
                $photogalleries->save();
            }
        }

        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.photogallery');
    }

    public function maanPhotogalleryEdit(Photogallery $photogallery)
    {
        return view('admin.pages.media.photo.edit',compact('photogallery'));
    }

    public function maanPhotogalleryUpdate(Request $request, Photogallery $photogallery)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',

        ]);
        if ($request->hasFile('image')){
            if ($photogallery->image){
                if (File::exists($photogallery->image)){
                    unlink($photogallery->image);
                }
            }

            $picture            = 'maanphotogallery'.date('dmY_His').'_'.$request->image->getClientOriginalName();
            // image path
            $image_url          = 'public/uploads/images/photogallery/' . $picture;
            //image base path
            $destinationPath    = base_path() . '/public/uploads/images/photogallery/';
            $success            = $request->image->move($destinationPath, $picture);
            if ($success){
                $image_urls     = $image_url ;
            }
        }else{
            $image_urls         = $photogallery->image ;
        }

        $photogallery->title          = $request->title;
        $photogallery->description    = $request->description;
        if ($request->status){
            $photogallery->status     = 1 ;
        }else{
            $photogallery->status     = 0 ;
        }
        $photogallery->image          = $image_urls;
        $photogallery->user_id          = Auth::user()->id;
        $photogallery->save();
        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.photogallery');
    }

    public function maanPhotogalleryDestroy(Photogallery $photogallery)
    {
        if (File::exists($photogallery->image)){
            unlink($photogallery->image);
        }
        $photogallery->delete();
        return redirect()->route('admin.photogallery');
    }
}
