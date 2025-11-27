<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FooterController extends Controller
{
    /**
     * Display a listing of the Footer .
     */
    public function maanFooterIndex()
    {
        $footers = Footer::latest()->paginate(10);

        return view('admin.pages.footer.index',compact('footers'));
    }

    public function maanFooterCreate ()
    {
        return view('admin.pages.footer.create');
    }

    public function maanFooterStore(Request $request)
    {
        $request->validate([
            'name'=> 'string',
            'image'=> 'image',
        ]);
        if ($request->hasFile('image')){
            $footer_imagename         = $request->file('image')->getClientOriginalName();
            $footer_image             = 'maanfooterimage'.date('dmY_His').'_'.$footer_imagename;
            $footer_image_url         = 'public/uploads/images/footer/' . $footer_image;
            $footer_destinationPath   = base_path() . '/public/uploads/images/footer/';
            $footer_success           = $request->file('image')->move($footer_destinationPath, $footer_image);
            if ($footer_success){
                $footer_image_urls = $footer_image_url  ;
            }
        }else{
            $footer_image_urls = '' ;
        }

        $footer = new Footer();
        $footer->name       = $request->name;
        $footer->name_slug  = Str::replace('-', '_',Str::slug($request->name));
        $footer->image      = $footer_image_urls;
        $footer->save();

        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.footer.index');
    }
    /**
     * Show the form for editing the Footer.
     */
    public function maanFooterEdit ($id)
    {
        $footer = Footer::find($id);
        return view('admin.pages.footer.edit',compact('footer'));

    }

    /**
     * update the Footer from storage.
     */
    public function maanFooterUpdate (Request $request, $id)
    {
        $request->validate([
            'name'=> 'string',
            'image'=> 'image',
        ]);

        $getimageurl = Footer::where('id',$id)->value('image');
        if ($request->hasFile('image')){
            if(File::exists($getimageurl)){
                unlink($getimageurl);
            }
            $footer_imagename         = $request->file('image')->getClientOriginalName();
            $footer_image             = 'maanfooterimage'.date('dmY_His').'_'.$footer_imagename;
            $footer_image_url         = 'public/uploads/images/footer/' . $footer_image;
            $footer_destinationPath   = base_path() . '/public/uploads/images/footer/';
            $footer_success           = $request->file('image')->move($footer_destinationPath, $footer_image);
            if ($footer_success){
                $footer_image_urls = $footer_image_url ;
            }
        }else{
            $footer_image_urls = $getimageurl ;
        }

        $footer = Footer::find($id);
        $footer->name       = $request->name;
        $footer->name_slug  = Str::replace('-', '_',Str::slug($request->name));
        $footer->image      = $footer_image_urls;
        $footer->save();

        //session message
        $this->setSuccess('Updated');
        //redirect route

        return redirect()->route('admin.footer.index');
    }

    public function maanFooterDestroy($id)
    {
        $footer = Footer::find($id);
        if (File::exists($footer->image)){
            unlink($footer->image);
        }
        $footer->delete();
        return redirect()->route('admin.footer.index');
    }
}
