<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BlogcategoryController extends Controller
{
    public function maanBlogCategoryIndex()
    {
        $categories = Blogcategory::paginate(10);

        return view('admin.pages.blog.category.index',compact('categories'));
    }
    /**
     * Store a listing of the requested data.
     *
     */
    public function maanBlogCategoryStore(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $blogcategory           = new Blogcategory();
        $blogcategory->name     = $request->name ;
        $blogcategory->user_id  = Auth()->user()->id;
        $blogcategory->save();

        return redirect()->route('admin.blog.category');

    }
    /**
     * Display a listing of the Blog Category edit data.
     *
     */

    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanBlogCategoryUpdate(Request $request, Blogcategory $blogcategory)
    {
        $request->validate([
            'name' => 'required'
        ]);


        Blogcategory::updateOrCreate(
            ['id'=>$blogcategory->id],
            ['name'=>$request->name,'user_id'=> Auth()->user()->id]
        );
        return redirect()->route('admin.blog.category');
    }

    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanBlogCategoryDestroy(Blogcategory $blogcategory)
    {
        $blogcategory->delete();
        return redirect()->route('admin.blog.category');
    }
}
