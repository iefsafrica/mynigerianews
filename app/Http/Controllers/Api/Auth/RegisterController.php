<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Maanuser;
use App\Providers\RouteServiceProvider;
use App\Models\Frontend\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

//    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required','numeric','unique:maanusers'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:maanusers'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return Builder|Model
     */
    protected function create(array $data)
    {
        return Maanuser::query()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email']??'',
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        if ($user) {
        $createdToken = $user->createToken('Password Grant user');
        $token = $createdToken->token;
        return response()->json([
            'status' => 'Success',
            'message' => 'Registration Successful',
            'user' => $user,
            'access_token' => $createdToken->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ],201);
        } else {
            return response()->json([
                'error' => 'User Registration Failed',
                'success' => 'false',
            ], 422);
        }
    }
}
