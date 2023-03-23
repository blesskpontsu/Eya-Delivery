<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendOtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;

class PhoneVerificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone' => ['required']
        ]);

        $phone = Auth::user()->phone;

        $http = Http::withHeaders([
            'api-key' => getenv("ARKESEL_API_TOKEN")
        ])->accept('application/json')
            ->post('https://sms.arkesel.com/api/otp/verify', [
                'code' => $request->verification_code,
                'number' => $phone
            ]);

        if ($http->json("code") == 1100) {
            $request->user()->markPhoneAsVerified();
            return redirect(RouteServiceProvider::HOME);
        } elseif ($http->json("code") == 1104) {
            return back()->with(['phone' => $phone, 'error' => 'Invalid verification code entered!']);
        }
    }

    public function resend()
    {
        $user = Auth::user();
        $phone = Auth::user()->phone;
        SendOtp::dispatch($user);
        return back()->with(['phone' => $phone]);
    }
}
