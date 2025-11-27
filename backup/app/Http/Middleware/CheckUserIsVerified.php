<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpFoundation\Response;

class CheckUserIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (Auth::check() && ! $request->user()->status || ! $request->user()->email_verified_at) {
            Auth::logout();
            Flash::error(__('messages.placeholder.your_account_is_currently_disabled_please_contact_to_administrator'));

            return \Redirect::to('login');
        }

        return $response;
    }
}
