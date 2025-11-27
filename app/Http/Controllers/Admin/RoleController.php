<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Symfony\Component\Console\Input\Input;

class RoleController extends Controller
{
    /**
     * Display a listing of the Course Role.
     *
     */
    public function maanRoleIndex()
    {
        $roles = Role::orderBy('id')->paginate(10);
        return view('admin.pages.roles.index',compact('roles'));
    }
    /**
     * Store a listing of the requested data.
     *
     */
    public function maanRoleStore(Request $request)
    {
        // validation posted data
        $data = $request->all();
        $data['permission'] = $request->has('permission') ? implode(',',$data['permission']) : null ;
        $rules = [ 'permission' => 'required|in:View,Create,Edit,Delete' ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            if (Role::where('name','=', $request->name)->exists()){
                $this->setError('Role already exists');
                return redirect()->back();
            }

            $roles                      = new Role();
            // name
            $roles->name                = $request->name;
            //institute
            $roles->slug                = str_replace(' ','-', strtolower(trim($request->name)));
            //store dada
            $roles->save();
            if ($request->permission){
                foreach ($request->permission as $permission){
                    $permissions            =new Permission();
                    $permissions->name      = $permission;
                    $permissions->slug      = strtolower(str_ireplace(' ','-',$permission)) ;
                    $permissions->save();
                    $roles->permissions()->attach($permissions->id);
                    $roles->save();
                }
            }

            //session message
            $this->setSuccess('Inserted');
            //redirect route
            return redirect()->route('admin.role');

        }catch (Exception $exception){
            $this->setError($exception->getMessage());
            return redirect()->back() ;

        }

    }
    /**
     * Display a listing of the Role edit data.
     *
     */
    public function maanRoleEdit($id)
    {
        //get all role data
        $role = Role::find($id);
        return view('admin.pages.roles.edit',compact('role')) ;
    }
    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanRoleUpdate(Request $request, $id)
    {
//dd($request);
        $role                      =Role::find($id);
        // name
        $role->name                = $request->name;
        //institute
        $role->slug                = str_replace(' ','-', strtolower(trim($request->name)));
        //store dada
        $role->save();

        $role->permissions()->delete();
        $role->permissions()->detach();
        foreach ($request->permission as $permission){
            $permissions            =new Permission();
            $permissions->name      = $permission;
            $permissions->slug      = strtolower(str_ireplace(' ','-',$permission)) ;
            $permissions->save();
            $role->permissions()->attach($permissions->id);
            $role->save();
        }

        //session message
        $this->setSuccess('Updated');
        //redirect route
        return redirect()->route('admin.role');
    }
    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanRoleDestroy ($id)
    {
        $role = Role::find($id);// find data that will delete

        //data delete
        $role->permissions()->delete();
        $role->delete();
        $role->permissions()->detach();

        //redirect route
        return redirect()->route('admin.role');
    }
}
