<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses autentikasi
    public function login(Request $request)
    {
        // Tangkap input dari 'username' atau 'email'
        $loginInput = $request->username ?? $request->email;

        $request->merge(['username' => $loginInput]);

        // 1. Validasi
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // 2. Petakan input ke kolom 'email' di Database (karena database menggunakan kolom email)
        $credentials = [
            'email'    => $loginInput,
            'password' => $request->password,
        ];

        // 3. Proses Attempt & Redirect
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
