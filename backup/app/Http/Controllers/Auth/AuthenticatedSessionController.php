<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $email = $request->email;
        $user = User::where(function ($q) use ($email) {
            $q->where('email', $email)->orWhere('username', $email);
        })->first();
        if (! empty($user)) {
            if (! empty($user['email']) && $user['email_verified_at'] == null) {
                Flash::error(__('messages.placeholder.your_account_is_currently_disabled_please_contact_to_administrator'));

                return redirect(route('login'));
            } else {
                if ($user['status'] == Staff::ACTIVE) {
                    if (Hash::check($request->get('password'), $user->password)) {
                        Auth::login($user);
                        $request->session()->regenerate();

                        return redirect()->intended(getDashboardURL());
                    } else {
                        Flash::error(__('messages.placeholder.these_credentials_do_not_match_our_records'));

                        return redirect(route('login'));
                    }
                } else {
                    Flash::error(__('messages.placeholder.your_account_is_currently_disabled_please_contact_to_administrator'));

                    return redirect(route('login'));
                }
            }
        } else {
            Flash::error(__('messages.placeholder.these_credentials_do_not_match_our_records'));

            return redirect(route('login'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
