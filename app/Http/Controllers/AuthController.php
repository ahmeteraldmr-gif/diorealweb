<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin(Request $request)
    {
        if ($request->session()->get('is_admin') === true) {
            return redirect()->route('admin.dashboard');
        }
        return view('login');
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // 1. Try Database authentication (email login or username admin fallback)
        if (\Illuminate\Support\Facades\Auth::attempt(['email' => $username, 'password' => $password])) {
            $request->session()->put('is_admin', true);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // 2. Try environment variables fallback
        $adminUser = env('ADMIN_USERNAME', 'admin');
        $adminPass = env('ADMIN_PASSWORD', 'admin');

        if ($username === $adminUser && $password === $adminPass) {
            $request->session()->put('is_admin', true);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'login_error' => 'Geçersiz kullanıcı adı veya şifre.',
        ])->withInput($request->only('username'));
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->forget('is_admin');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
