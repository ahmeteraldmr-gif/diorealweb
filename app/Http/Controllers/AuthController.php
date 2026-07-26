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

        $username = trim($request->input('username'));
        $password = trim($request->input('password'));

        // 1. Try Database authentication (match email or name)
        $user = \App\Models\User::where('email', $username)
            ->orWhere('name', $username)
            ->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($password, $user->password)) {
            \Illuminate\Support\Facades\Auth::login($user);
            $request->session()->put('is_admin', true);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // 2. Exact fallback for requested credentials
        $targetUser = env('ADMIN_USERNAME', 'DioTurkReal.13');
        $targetPass = env('ADMIN_PASSWORD', 'xYdioReal.13xY');

        if (($username === $targetUser || $username === 'DioTurkReal.13') && ($password === $targetPass || $password === 'xYdioReal.13xY')) {
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
