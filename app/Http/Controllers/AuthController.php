<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }

    public function login(LoginAuthRequest $request)
    {
        if (Auth::attempt(['email' => $request->validated('email'), 'password' => $request->validated('password')])) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'marketing') {
                return redirect()->route('marketing.dashboard');
            }

            if ($user->role === 'kasir') {
                return redirect()->route('kasir');
            }

            Auth::logout();
            return redirect()->route('login')->withErrors(['role' => 'Unknown roles']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
