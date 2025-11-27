<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newscategory;
use App\Models\Newssubcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\Input;

class NewscategoryController extends Controller
{
    /**
     * Display a listing of the News Category.
     *
     */
    public function maanNewsCategoryIndex()
    {
        $categories = Newscategory::paginate(10);

        return view('admin.pages.news.category.index',compact('categories'));
    }
    /**
     * Store a listing of the requested data.
     *
     */
    public function maanNewsCategoryStore(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'type'=>'required',
            'image'=>'required'
        ]);
        //image validation..
        if ($request->image!=''){
            $request->validate([
                'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:150|dimensions:max_width=750,max_height=400',
            ],[

                'image.dimensions'    => 'Required image maximum  750x400 image',
                'image.max'  => 'image size should not be more than 150 kB'
            ]);

        }
        $getnewscategoryexist = Newscategory::where('type',$request->type)->exists();
        //return $getnewscategoryexist;
        if ($getnewscategoryexist) {
            $getnewscategory = Newscategory::where('type',$request->type)->first();
            if ($getnewscategory->type=='home' || $getnewscategory->type=='contact') {
                $newscategories = $getnewscategory ;
            }else{
                $newscategories           = new Newscategory();
            }
        }else {
            $newscategories           = new Newscategory();
        }

        // image..
        if ($request->hasFile('image')){

            if ($request->image!=''){
                if ($getnewscategory->type=='home' || $getnewscategory->type=='contact') {
                    if (File::exists($newscategories->image)){
                        unlink($newscategories->image);
                    }
                }


                $image            = trim(str_replace(' ', '_', strtolower($request->name))).'.'.$request->image->getClientOriginalExtension();

                // image path
                $image_url          = 'public/uploads/images/news_category/' . $image;
                //image base path
                $destinationPath    = base_path() . '/public/uploads/images/news_category/';
                $success            = $request->image->move($destinationPath, $image);
                if ($success){
                    $image_urls     = $image_url ;
                }
            }else{
                $image_urls         = '' ;
            }
        }

        $newscategories->name     = trim($request->name) ;
        $newscategories->slug     = trim(strtolower($request->slug)) ;
        $newscategories->type     = trim(strtolower($request->type)) ;
        $newscategories->image    = $image_urls ;
        $newscategories->user_id  = Auth()->user()->id;
        $newscategories->save();
        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.news.category');

    }
    /**
     * Display a listing of the News Category edit data.
     *
     */

    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanNewsCategoryUpdate(Request $request, Newscategory $newscategory)
    {
         $request->validate([
             'name' => 'required',
             'slug' => 'required',
             'type' => 'required',
         ]);
        if ($request->image!=''){
            $request->validate([
                'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:150|dimensions:max_width=750,max_height=400',
            ],[

                'image.dimensions'    => 'Required image maximum 750x400 image',
                'image.max'           => 'image size should not be more than 150 kB'
            ]);

        }

        if ($request->hasFile('image')){

            if ($request->image!=''){

                if (File::exists($newscategory->image)){
                    unlink($newscategory->image);
                }

                $image            = trim(str_replace(' ', '_', strtolower($request->name))).'.'.$request->image->getClientOriginalExtension();
                // image path
                $image_url          = 'public/uploads/images/news_category/' . $image;
                //image base path
                $destinationPath    = base_path() . '/public/uploads/images/news_category/';
                $success            = $request->image->move($destinationPath, $image);
                if ($success){
                    $image_urls     = $image_url ;
                }
            }else{
                $image_urls         = $newscategory->image ;
            }
        }else{
            $image_urls         = $newscategory->image ;
        }


        Newscategory::updateOrCreate(
            ['id'=>$newscategory->id],
            ['name'=>$request->name,'slug'=>trim(strtolower($request->slug)),'type'=>trim(strtolower($request->type)),'image'=>$image_urls,'user_id'=> Auth()->user()->id]
        );
        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.news.category');
    }

    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanNewsCategoryDestroy(Newscategory $newscategory)
    {
        $newscategory->delete();
        return redirect()->route('admin.news.category');
    }

}
