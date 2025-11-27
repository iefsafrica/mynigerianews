<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the User .
     * Create a User .
     *
     */
    public function maanUserIndex()
    {
        $users= User::paginate(10);
        return view('admin.pages.users.index',compact('users'));
    }

    public function maanUserCreate(Request $request)
    {
        if ($request->ajax()){
            $roles = Role::where('id',$request->role_id)->first() ;
            $permissions = $roles->permissions;
            return $permissions;
        }
        $roles = Role::all();
        return view('admin.pages.users.create',compact('roles'));
    }
    /**
     * Store a listing of the requested data.
     *
     */
    public function maanUserStore(Request $request)
    {
        // validation posted data
        $validator = Validator::make($request->all(),[
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
            'uesr_type'=> 'required',
            'password'=>'required',
            'password_confirmation'=>'required|same:password',

        ]);
        if ($request->hasFile('image')){
            $user_imagename         = $request->file('image')->getClientOriginalName();
            $user_image             = 'maanuserimage'.date('dmY_His').'_'.$user_imagename;
            $user_image_url         = 'public/uploads/images/userimages/' . $user_image;
            $user_destinationPath   = base_path() . '/public/uploads/images/userimages/';
            $user_success           = $request->file('image')->move($user_destinationPath, $user_image);
            if ($user_success){
                $user_image_urls = $user_image_url ;
            }
        }else{
            $user_image_urls = '' ;
        }

        $users = new User();
        $users->first_name          = $request->first_name ;
        $users->last_name           = $request->last_name ;
        $users->email               = $request->email ;
        $users->phone               = $request->phone ;
        $users->password            = Hash::make($request->password) ;
        $users->user_name           = ucfirst(trim(strtolower($request->first_name)).trim(strtolower($request->last_name)));
        $users->user_type           = $request->user_type ;
        $users->national_id         = $request->national_id ;
        $users->father_name         = $request->father_name ;
        $users->mother_name         = $request->mother_name ;
        $users->present_address     = $request->present_address ;
        $users->permanent_address   = $request->permanent_address ;
        $users->appointed_date      = date('Y-m-d', strtotime($request->appointed_date));
        $users->image               = $user_image_urls;
        $users->save();

        if ($request->role != null){
            $users->roles()->attach($request->role);
            $users->save();
        }

        if ($request->permissions != null){
            foreach ($request->permissions as $permission){
                $users->permissions()->attach($permission);
                $users->save();
            }
        }
        //session message
        $this->setSuccess('Inserted');
        //redirect route
            return redirect()->route('admin.user');
    }
    /**
     * Display a listing of the user edit data.
     *
     */
    public function maanUserEdit(User $user)
    {
//get all user data

        $roles =Role::get();
        $userRole = $user->roles->first();
        if ($userRole!=null){
            $rolePermissions = $userRole->permissions;
        }else{
            $rolePermissions = null;
        }
        $userPermissions = $user->permissions;

        return view('admin.pages.users.edit',compact('user','roles','userRole','rolePermissions','userPermissions')) ;
    }
    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanUserUpdate(Request $request, User $user)
    {

        // validation posted data
        $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|email|unique:users,email,'.$user->id,
            'phone'=> 'required',
            'national_id'=> 'required',
            'father_name'=> 'required',
            'mother_name'=> 'required',
            'present_address'=> 'required',
            'permanent_address'=> 'required',
            'appointed_date'=> 'required',
            'user_type'=> 'required',

        ]);

        $getimageurl = User::where('id',$user->id)->value('image');

        if ($request->hasFile('image')){
            if(File::exists($getimageurl)){
                unlink($getimageurl);
            }
            $user_imagename         = $request->file('image')->getClientOriginalName();

            $user_image             = 'maanuserimage'.date('dmY_His').'_'.$user_imagename;
            $user_image_url         = 'public/uploads/images/userimages/' . $user_image;
            $user_destinationPath   = base_path() . '/public/uploads/images/userimages/';
            $user_success           = $request->file('image')->move($user_destinationPath, $user_image);
            if ($user_success){
                $user_image_urls = $user_image_url ;
            }
        }else{
            $user_image_urls = $getimageurl ;
        }


        $user->first_name          = $request->first_name ;
        $user->last_name           = $request->last_name ;
        $user->email               = $request->email ;
        $user->phone               = $request->phone ;
        if ($request->password !=NULL){
            $user->password        = Hash::make($request->password) ;
        }
        $user->user_name           = ucfirst(trim(strtolower($request->first_name)).trim(strtolower($request->last_name)));;
        $user->user_type           = $request->user_type ;
        $user->national_id         = $request->national_id ;
        $user->father_name         = $request->father_name ;
        $user->mother_name         = $request->mother_name ;
        $user->present_address     = $request->present_address ;
        $user->permanent_address   = $request->permanent_address ;
        $user->appointed_date      = date('Y-m-d', strtotime($request->appointed_date));
        $user->image               = $user_image_urls;
        $user->save();

        $user->roles()->detach();
        $user->permissions()->detach();

        if ($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        if ($request->permissions != null){
            foreach ($request->permissions as $permission){
                $user->permissions()->attach($permission);
                $user->save();
            }
        }
        //session message
        $this->setSuccess('Updated');
        //redirect route
        //redirect route
        return redirect()->route('admin.user');
    }
    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanuserdestroy (User $user)
    {

        //data delete
        if (File::exists($user->image)){
            unlink($user->image);
        }
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        //redirect route
        return redirect()->route('admin.user');
    }
    /**
     * Ajax request.
     *
     */
    public function maanUserAjax(Request $request)
    {
        if ($request->ajax()){
            $roles = Role::where('id',$request->role_id)->first() ;
            $permissions = $roles->permissions;
            return $permissions;
        }

    }

}
