<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newscategory;
use App\Models\Newssubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewssubcategoryController extends Controller
{
    public function maanNewsSubcategoryIndex()
    {
        $categories = Newscategory::all();
        $subcategories = Newssubcategory::paginate(10);

        return view('admin.pages.news.subcategory.index',compact('subcategories','categories'));
    }

    public function maanNewsSubcategoryStore(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required'
        ]);

         $request->request->add([ 'user_id'=>Auth::user()->id ]);

        Newssubcategory::create($request->all());
        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.news.subcategory');

    }

    public function maanNewsSubcategoryUpdate(Request $request, Newssubcategory $newssubcategory)
    {
        $request->validate([
            'name'          => 'required',
            'category_id'   => 'required'
        ]);

        $request->request->add([ 'user_id'=>Auth::user()->id ]);

        $newssubcategory->update($request->all());
        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.news.subcategory');

    }

    public function maanNewsSubcategoryDestroy(Newssubcategory $newssubcategory)
    {
        $newssubcategory->delete();
        //redirect route
        return redirect()->route('admin.news.subcategory');
    }


}
