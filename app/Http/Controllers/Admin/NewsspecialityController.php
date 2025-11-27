<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsspeciality;
use Illuminate\Http\Request;

class NewsspecialityController extends Controller
{
    public function maanNewsSpecialityIndex()
    {
        $specialities = Newsspeciality::paginate(10);
        return view('admin.pages.news.speciality.index',compact('specialities'));
    }

    public function maanNewsSpecialityUpdate(Request $request,Newsspeciality $newsspeciality)
    {
        $request->validate([
            'name'=>'required'
        ]);
        $newsspeciality->update($request->all());
        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.news.speciality');

    }
}
