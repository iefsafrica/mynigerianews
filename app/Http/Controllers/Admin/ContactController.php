<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function maancontact()
    {
        $contacts = Contact::paginate(10);
        return view('admin.pages.contacts.index',compact('contacts'));
    }
    public function maancontactdestroy ($id)
    {
        $contact = Contact::find($id);// find data that will delete
        //data delete
        $contact->delete();

        //redirect route
        return redirect()->route('admin.contact');
    }
}
