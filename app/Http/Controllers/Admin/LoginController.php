<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:8|max:30',
        ], [
            'email.exists' => 'This email is not in our records'
        ]);

        $verify = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($verify)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors(['message' => 'Invalid email or password']);
    }

    public function logout()
    {
        Session::flash();
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
