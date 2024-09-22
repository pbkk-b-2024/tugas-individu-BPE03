<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Menampilkan Halaman Login
    public function show()
    {
        return view('auth.login');
    }

    // Untuk Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Cek apakah data valid
        if (Auth::attempt($credentials)) {
            // Jika valid, redirect ke halaman dashboard
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        // Jika tidak valid, kembali ke halaman login
        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    // Untuk Logout
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
