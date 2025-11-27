<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Maanuser;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required|exists:maanusers,email'
        ]);

        $user = Maanuser::query()
            ->where('email', $request->email)
            ->where('verification_code', $request->code)
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry! Verification code is Wrong!'
            ], 200);
        }
        if ($user && $user->verification_expire_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Code Verification Successful!'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Your password has been changed!',
        ], 200);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = Maanuser::query()
            ->where('email', $request->email)
            ->where('verification_code', $request->code)
            ->first();

        if ($user->verification_expire_at < now()) {
            return response()->json([
                'success' => true,
                'message' => 'Verification code expired!'
            ], 200);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return response()->json([
            'success' => true,
            'message' => 'Your password has been changed!',
        ], 200);
    }


}
