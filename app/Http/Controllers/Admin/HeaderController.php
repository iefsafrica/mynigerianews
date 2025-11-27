<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HeaderController extends Controller
{
    /**
     * Display a listing of the Header .
     */
    public function maanHeaderIndex()
    {
        $headers = Header::latest()->paginate(10);

        return view('admin.pages.header.index',compact('headers'));
    }
    public function maanHeaderCreate ()
    {
        return view('admin.pages.header.create');
    }
    public function maanHeaderStore(Request $request)
    {
        $request->validate([
            'name'=> 'required|string',
            'image'=> 'required|image',
        ]);
        if ($request->hasFile('image')){
            $header_imagename         = $request->file('image')->getClientOriginalName();
            $header_image             = 'maanheaderimage'.date('dmY_His').'_'.$header_imagename;
            $header_image_url         = 'public/uploads/images/header/' . $header_image;
            $header_destinationPath   = base_path() . '/public/uploads/images/header/';
            $header_success           = $request->file('image')->move($header_destinationPath, $header_image);
            if ($header_success){
                $header_image_urls = $header_image_url  ;
            }
        }else{
            $header_image_urls = '' ;
        }

        $header = new Header();
        $header->name       = $request->name;
        $header->name_slug  = Str::replace('-', '_',Str::slug($request->name));
        $header->image      = $header_image_urls;
        $header->save();

        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.header.index');
    }
    /**
     * Show the form for editing the Header.
     */
    public function maanHeaderEdit ($id)
    {
        $header = Header::find($id);
        return view('admin.pages.header.edit',compact('header'));

    }

    /**
     * update the Header from storage.
     */
    public function maanHeaderUpdate (Request $request, $id)
    {
        $request->validate([
            'name'=> 'required|string',
        ]);
        if ($request->image) {
            $request->validate([
                'image'=> 'required|image',
            ]);
        }

        $getimageurl = Header::where('id',$id)->value('image');
        if ($request->hasFile('image')){
            if(File::exists($getimageurl)){
                unlink($getimageurl);
            }
            $header_imagename         = $request->file('image')->getClientOriginalName();
            $header_image             = 'maanheaderimage'.date('dmY_His').'_'.$header_imagename;
            $header_image_url         = 'public/uploads/images/header/' . $header_image;
            $header_destinationPath   = base_path() . '/public/uploads/images/header/';
            $header_success           = $request->file('image')->move($header_destinationPath, $header_image);
            if ($header_success){
                $header_image_urls = $header_image_url ;
            }
        }else{
            $header_image_urls = $getimageurl ;
        }

        $header = Header::find($id);
        $header->name       = $request->name;
        $header->name_slug  = Str::replace('-', '_',Str::slug($request->name));
        $header->image      = $header_image_urls;
        $header->save();

        //session message
        $this->setSuccess('Updated');
        //redirect route

        return redirect()->route('admin.header.index');
    }

    public function maanHeaderDestroy($id)
    {
        $header = Header::find($id);
        if (File::exists($header->image)){
            unlink($header->image);
        }
        $header->delete();
        return redirect()->route('admin.header.index');
    }
}
