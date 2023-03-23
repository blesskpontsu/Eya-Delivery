<?php

namespace App\Http\Middleware;

use App\Interfaces\MustVerifyMobile;
use App\Interfaces\MustVerifyPhone;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsurePhoneNumberIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        $phone = Auth::user()->phone;

        if (
            !$request->user() ||
            ($request->user() instanceof MustVerifyPhone &&
                !$request->user()->hasVerifiedPhone())
        ) {
            return $request->expectsJson()
                ? abort(code: 403, message: 'Mobile Phone is not verified yet')
                : Redirect::guest(URL::route(name: $redirectToRoute ?: 'verify'))->with(['phone' => $phone, 'error' => 'You need to verify your phone number first']);
        }

        return $next($request);
    }
}
