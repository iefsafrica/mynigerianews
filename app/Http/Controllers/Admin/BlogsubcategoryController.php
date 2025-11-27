<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use App\Models\Blogsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsubcategoryController extends Controller
{
    public function maanBlogSubcategoryIndex()
    {
        $categories = Blogcategory::all();
        $subcategories = Blogsubcategory::paginate(10);

        return view('admin.pages.blog.subcategory.index',compact('subcategories','categories'));
    }

    public function maanBlogSubcategoryStore(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required'
        ]);

        $request->request->add([ 'user_id'=>Auth::user()->id ]);

        Blogsubcategory::create($request->all());
        //session message
        $this->setSuccess('Inserted');

        //redirect route
        return redirect()->route('admin.blog.subcategory');

    }

    public function maanBlogSubcategoryUpdate(Request $request, Blogsubcategory $blogsubcategory)
    {
        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required'
        ]);

        $request->request->add([ 'user_id'=>Auth::user()->id ]);

        $blogsubcategory->update($request->all());
        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.blog.subcategory');

    }

    public function maanBlogSubcategoryDestroy(Blogsubcategory $blogsubcategory)
    {
        $blogsubcategory->delete();
        //redirect route
        return redirect()->route('admin.blog.subcategory');
    }
}
