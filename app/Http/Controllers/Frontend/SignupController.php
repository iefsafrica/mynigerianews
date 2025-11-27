<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Maanuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class SignupController extends Controller
{
    /**
     * Display of the SignUp information .
     *
     */
    public function maanSignupIndex()
    {
        return view('frontend.pages.signup');
    }
    /**
     * Store of the requested data.
     *
     */
    public function maanSignupStore(Request $request)
    {
        // validation posted data
        $validator = Validator::make($request->all(),[
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required|numeric|unique:maanusers',
            'email'=>'required|email|unique:maanusers',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password',

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $maanusers                      = new Maanuser();
            // first name
            $maanusers->first_name          = $request->first_name;
            // last name
            $maanusers->last_name           = $request->last_name;
            // user mobile
            $maanusers->phone               = $request->phone;
            //email
            $maanusers->email               = $request->email;
            $maanusers->password            = bcrypt($request->password);
            //store data
            $maanusers->save();
            //success message
            $this->setSuccess('Data Inserted Successfully');
            return redirect()->route('signin');

        }catch (Exception $exception){
            $this->SetError($exception->getMessage());
            return redirect()->back() ;
        }
    }
}
