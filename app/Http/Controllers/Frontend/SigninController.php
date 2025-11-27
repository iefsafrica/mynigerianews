<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SigninController extends Controller
{
    public function maanSigninIndex()
    {
        return view('frontend.pages.signin');
    }
    public function maanSigninLogin(Request $request)
    {

        if(Auth::guard('maanuser')->attempt(['email' => $request->email, 'password' => $request->password])){
            //return Auth::guard('maanuser')->user();
            Session::flash('message', 'Success message !');
            //return 'Success';
            return redirect()->route('maanuser.index');
        }else{
            //If is invalid email or password,will be redirect to back
            $this->setError('Invalid Email or Password !');
            return redirect()->back();
        }


    }
    public function maanSignout()
    {
        \auth()->logout() ;
        $this->setSuccess('User logout Successfully !');
        return redirect()->route('home');
    }
}
