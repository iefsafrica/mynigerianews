<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class NewsreporterController extends Controller
{
    /**
     * Display a listing of the Reporter .
     * Create a Reporter .
     *
     */
    public function maanReporterIndex()
    {
        $reporters = User::where('user_type','0')->paginate(10);

        return view('admin.pages.reporter.index',compact('reporters'));
    }
    /**
     *
     * Create a Reporter .
     *
     */
    public function maanReporterCreate (Request $request)
    {
        if ($request->ajax()){
            $roles = Role::where('id',$request->role_id)->first() ;
            $permissions = $roles->permissions;
            return $permissions;
        }
        $roles = Role::where('slug','reporter')->get();
        return view('admin.pages.reporter.create',compact('roles'));
    }
    /**
     * Store a listing of the requested data.
     *
     */
    public function maanReporterStore(Request $request)
    {
        $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|email|unique:users',
            'phone'=> 'required',
            'national_id'=> 'required',
            'father_name'=> 'required',
            'mother_name'=> 'required',
            'present_address'=> 'required',
            'permanent_address'=> 'required',
            'appointed_date'=> 'required',
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
        ]);
        if ($request->hasFile('image')){
            $reporter_imagename         = $request->file('image')->getClientOriginalName();
            $reporter_image             = 'maanreporterimage'.date('dmY_His').'_'.$reporter_imagename;
            $reporter_image_url         = 'public/uploads/images/reporterimages/' . $reporter_image;
            $reporter_destinationPath   = base_path() . '/public/uploads/images/reporterimages/';
            $reporter_success           = $request->file('image')->move($reporter_destinationPath, $reporter_image);
            if ($reporter_success){
                $reporter_image_urls = $reporter_image_url ;
            }
        }else{
            $reporter_image_urls = '' ;
        }

            $reporters = new User();
            $reporters->first_name          = $request->first_name ;
            $reporters->last_name           = $request->last_name ;
            $reporters->email               = $request->email ;
            $reporters->phone               = $request->phone ;
            $reporters->password            = Hash::make($request->password) ;
            $reporters->user_name           = trim(strtolower($request->first_name)).trim(strtolower($request->last_name));
            $reporters->user_type           = '0' ;
            $reporters->national_id         = $request->national_id ;
            $reporters->father_name         = $request->father_name ;
            $reporters->mother_name         = $request->mother_name ;
            $reporters->present_address     = $request->present_address ;
            $reporters->permanent_address   = $request->permanent_address ;
            $reporters->appointed_date      = date('Y-m-d', strtotime($request->appointed_date));
            $reporters->image               = $reporter_image_urls;
            $reporters->save();

        if ($request->role != null){
            $reporters->roles()->attach($request->role);
            $reporters->save();
        }

        if ($request->permissions != null){
            foreach ($request->permissions as $permission){
                $reporters->permissions()->attach($permission);
                $reporters->save();
            }
        }
        //session message
        $this->setSuccess('Inserted');
        //redirect route
        return redirect()->route('admin.reporter');
    }
    /**
     * Display a listing of the reporter edit data.
     *
     */
    public function maanReporterEdit($reporter)
    {
        $roles =Role::where('slug','reporter')->get();
         $reporter = User::where('id',$reporter)->first();
        $reporterRole = $reporter->roles->first();
        if ($reporterRole!=null){
            $rolePermissions = $reporterRole->permissions;
        }else{
            $rolePermissions = null;
        }
        $reporterPermissions = $reporterRole->permissions;


        return view('admin.pages.reporter.edit',compact('reporter','roles','reporterRole','rolePermissions','reporterPermissions'));
    }
    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanReporterUpdate(Request $request,$reporter)
    {
        $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|email|unique:users,email,'.$reporter,
            'phone'=> 'required',
            'national_id'=> 'required',
            'father_name'=> 'required',
            'mother_name'=> 'required',
            'present_address'=> 'required',
            'permanent_address'=> 'required',
            'appointed_date'=> 'required',

        ]);

        $getimageurl = User::where('id',$reporter)->value('image');

        if ($request->hasFile('image')){
            if(File::exists($getimageurl)){
                unlink($getimageurl);
            }
            $reporter_imagename         = $request->file('image')->getClientOriginalName();

            $reporter_image             = 'maanreporterimage'.date('dmY_His').'_'.$reporter_imagename;
            $reporter_image_url         = 'public/uploads/images/reporterimages/' . $reporter_image;
            $reporter_destinationPath   = base_path() . '/public/uploads/images/reporterimages/';
            $reporter_success           = $request->file('image')->move($reporter_destinationPath, $reporter_image);
            if ($reporter_success){
                $reporter_image_urls = $reporter_image_url ;
            }
        }else{
            $reporter_image_urls = $getimageurl ;
        }

        $reporter = User::find( $reporter);
        $reporter->first_name          = $request->first_name ;
        $reporter->last_name           = $request->last_name ;
        $reporter->email               = $request->email ;
        $reporter->phone               = $request->phone ;
        if ($request->password !=NULL){
            $reporter->password        = Hash::make($request->password) ;
        }
        $reporter->user_name           = trim(strtolower($request->first_name)).trim(strtolower($request->last_name));
        $reporter->user_type           = '0' ;
        $reporter->national_id         = $request->national_id ;
        $reporter->father_name         = $request->father_name ;
        $reporter->mother_name         = $request->mother_name ;
        $reporter->present_address     = $request->present_address ;
        $reporter->permanent_address   = $request->permanent_address ;
        $reporter->appointed_date      = date('Y-m-d', strtotime($request->appointed_date));
        $reporter->image               = $reporter_image_urls;
        $reporter->save();
        $reporter->roles()->detach();
        $reporter->permissions()->detach();

        if ($request->role != null){
            $reporter->roles()->attach($request->role);
            $reporter->save();
        }

        if ($request->permissions != null){
            foreach ($request->permissions as $permission){
                $reporter->permissions()->attach($permission);
                $reporter->save();
            }
        }

        //session message
        $this->setSuccess('Updated');
        //redirect route

        return redirect()->route('admin.reporter');
    }
    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanReporterDestroy($reporter)
    {
        $reporterfiend = User::find($reporter);
        if (File::exists($reporterfiend->image)){
            unlink($reporterfiend->image);
        }
        $reporterfiend->roles()->detach();
        $reporterfiend->permissions()->detach();
        $reporterfiend->delete();
        return redirect()->route('admin.reporter');
    }
}
