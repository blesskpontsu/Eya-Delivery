<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PhoneVerificationPromptController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        $phone = Auth::user()->phone;

        return $request->user()->hasVerifiedPhone()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : view('auth.verify')->with(['phone' => $phone]);
    }
}
