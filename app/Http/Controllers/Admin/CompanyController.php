<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function maanCompanyIndex()
    {

        $companies = Company::paginate(10);
        return view('admin.pages.settings.company.index',compact('companies'));
    }

    public function maanCompanyStore(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address_line1'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'message'=>'required',
            'copyright'=>'required',
            'version'=>'required',

        ]);
        $companies                  = new Company();
        $companies->name            = $request->name;
        $companies->address_line1   = $request->address_line1;
        $companies->address_line2   = $request->address_line2;
        $companies->phone           = $request->phone;
        $companies->email           = $request->email;
        $companies->location_map    = $request->location_map;
        $companies->message         = $request->message;
        $companies->copyright         = $request->copyright;
        $companies->version         = $request->version;
        $companies->save();
        //message..
        $this->setSuccess('Inserted');

        return redirect()->route('admin.company.index');


    }

    public function maanCompanyUpdate(Request $request, Company $company)
    {
        $request->validate([
            'name'=>'required',
            'address_line1'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'message'=>'required',
            'copyright'=>'required',
            'version'=>'required',

        ]);

        $company->name            = $request->name;
        $company->address_line1   = $request->address_line1;
        $company->address_line2   = $request->address_line2;
        $company->phone           = $request->phone;
        $company->email           = $request->email;
        $company->location_map    = $request->location_map;
        $company->message         = $request->message;
        $company->copyright         = $request->copyright;
        $company->version         = $request->version;
        $company->save();
        //message..
        $this->setSuccess('Updated');

        return redirect()->route('admin.company.index');
    }

    public function maanCompanyDestroy(Company $company)
    {
        $company->delete();
        return redirect()->route('admin.company.index');

    }
}
