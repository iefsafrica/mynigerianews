<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRegisterRequest;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (! getSettingValue()['registration_system']) {
            return redirect(route('login'));
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(CreateRegisterRequest $request): RedirectResponse
    {
        if ((getSettingValue()['show_captcha_on_registration'] == '1') && $request['g-recaptcha-response'] == null) {
            Flash::error(__('messages.placeholder.reCAPTCHA_required'));

            return redirect()->back();
        }
        try {
            DB::beginTransaction();

            //            $userDefaultLanguage = Setting::where('key', 'user_default_language')->first()->value ?? 'en';
            $adminRole = Role::whereName('customer')->first();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'language' => 'en',
                'password' => Hash::make($request->password),
                'type' => User::STAFF,
                'username' => $request->username,
            ])->assignRole($adminRole);

            $plan = Plan::whereIsDefault(true)->first();

            Subscription::create([
                'plan_id' => $plan->id,
                'plan_amount' => $plan->price,
                'plan_frequency' => Plan::MONTHLY,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays($plan->trial_days),
                'trial_ends_at' => Carbon::now()->addDays($plan->trial_days),
                'status' => Subscription::ACTIVE,
                'user_id' => $user->id,
                'no_of_post' => $plan->post_count,
            ]);

            DB::commit();

            event(new Registered($user));

            Flash::success(__('messages.placeholder.registered_success'));

            return redirect(route('login'));
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
