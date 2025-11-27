<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\Models\Maanuser;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetEmail(Request $request)
    {
        $this->validate($request,[
          'email' => 'required|exists:maanusers,email'
        ]);

        // Generate password reset verification code and expire date for
        // the verification code. The code and the expiry date will store in
        // database. The verification code won't work after the expiry date.
        $code = random_int(100000,999999);
        $expire = now()->addHour();
        $user = Maanuser::query()
            ->where('email',$request->email)
            ->first();
        $user->update(['verification_code'=>$code,'verification_expire_at'=>$expire]);

        $url = url('password/reset');

        $data = [
            'code' => $code
        ];

        try{
            Mail::to($request->email)->send(new PasswordReset($data));
        }catch (\Exception $exception){
            return response()->json([
                'success' => 'false',
                'message' => $exception->getMessage(),
            ], 422);
        }

        if(Mail::failures() != 0) {
            return response()->json([
                'success' => true,
                'message' => 'password reset code has been sent to your email',
            ], 200);
        }
        return response()->json([
            'success' => 'false',
            'message' => 'Failed',
        ], 422);
    }
}
