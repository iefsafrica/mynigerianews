<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactusController extends Controller
{
    public function maanNewsContactus()
    {
        $company = Company::where('status',1)->latest()->first();
        return view('frontend.pages.contactus',compact('company'));
    }
    public function maanNewsContactusStore(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'message'=>'required'
        ]);

            $contacts                           = new Contact();
            // first name
            $contacts->name                     = $request->name;
            //email
            $contacts->email                    = $request->email;
            //email
            $contacts->website                  = $request->website;
            //message
            $contacts->message                  = $request->message;
            //store data
            $contacts->save();
            //success message
            $this->setSuccess('Data Inserted Successfully');
            return redirect()->route('contactus');

    }
}
