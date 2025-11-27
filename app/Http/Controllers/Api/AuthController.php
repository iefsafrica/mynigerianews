<?php

namespace App\Http\Controllers\Api;

use App\Models\Api\ApiUser;
use App\Models\Maanuser;
use App\Traits\ApiResponse;
use App\Traits\ResponseMessage;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseMessage, ApiResponse;

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        if($provider=='facebook')
            $data =\Config::get( 'services.facebook' );
        if($provider=='google')
            $data =\Config::get( 'services.google' );
        return $this->successResponse($data,$this->load_success['message']);
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback(Request $request): JsonResponse
    {
        /*$validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }*/

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'provider' => ['required', 'string',],
            'provider_id' => ['required'],
            'avatar' => ['required'],
        ]);

        $userCreated = Maanuser::firstOrCreate(
            [
                'email' => $request->email
            ],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $request->provider,
                'provider_id' => $request->provider_id,
            ],
            [
                'avatar' => $request->avatar
            ]
        );
        if($userCreated) {
            $createdToken = $userCreated->createToken('social_token');
            $token = $createdToken->token;
            return response()->json([
                'success' => true,
                'message' => 'Successful',
                'user' => $userCreated,
                'access_token' => $createdToken->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
            ], 201);
        }else{
            return response()->json([
                'error' => 'Failed',
                'success' => 'false',
            ], 422);
        }

    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }

    public function updateProfile(Request $request){
        $user = Auth('api')->user();
        if ($user) {
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:maanusers,email,' . $user->id],
                'phone' => ['nullable'],
//            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            ]);
            $data = $request->only(['first_name','last_name', 'email','phone']);

            $user->update($data);
            return response()->json([
                'success'  => true,
                'message' => 'Profile Updated',
            ], 200);

        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Unauthenticated',
            ], 401);
        }
    }
    public function changePassword(Request $request){
        $user = Auth('api')->user();
        if ($user) {
            $request->validate([
                'password' => ['nullable', 'string', 'min:6', 'confirmed'],
                'current_password' => ['nullable', 'string', 'min:6'],
            ]);
            $data = [];
            if ($request->password) {
                if (Hash::check($request->current_password, $user->password)) {
                    $data['password'] = Hash::make($request->input('password'));
                } else {
                    return response()->json([
                        'success'  => false,
                        'message' => 'Current Password is not Match',
                    ]);
                }
            }
            $user->update($data);
            return response()->json([
                'success'  => true,
                'message' => 'Password Updated',
            ], 200);

        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Unauthenticated',
            ], 401);
        }
    }

}
