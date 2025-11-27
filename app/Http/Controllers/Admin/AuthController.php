<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the login.
     *
     */
    public function maanIndex()
    {
        return view('login.login');
    }
    /**
     * Check login user email password.
     *
     */
    public function maanLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $this->setSuccess('User login Successfully !');
            return redirect()->route('admin.dashboard');
        }else{
            //If is invalid email or password,will be redirect to back
            $this->setError('Invalid Email or Password !');
            return redirect()->back();
        }


    }
    public function maanLogout()
    {
        //If logout redirect to login page
        auth()->logout() ;
        $this->setSuccess('User logout Successfully !');
        return redirect()->route('login');
    }
}
