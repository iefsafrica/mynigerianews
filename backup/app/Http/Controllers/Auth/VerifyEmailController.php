<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request): RedirectResponse
    {          /** @var User $user */
        $user = User::find($request->route('id'));
        if ($user->hasVerifiedEmail()) {
            Flash::success(__('messages.placeholder.your_mail_already_verified'));

            return redirect(route('login'));
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        Flash::success(__('messages.placeholder.successfully_verified'));

        return redirect(route('login'));
    }
}
