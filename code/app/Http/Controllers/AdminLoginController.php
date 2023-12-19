<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    //
    public function login(Request $request)
    {
        Log::info('Login attempt', ['email' => $request->email]); // Log sebelum validasi

        $request->validate([
            'email' => 'required|email',
            // 'password' => 'required|string|min:8|max:20',
            'password' => [
                'required',
                'string',
                'min:8',             // Minimal 8 karakter
                'max:20',            // Maksimal 20 karakter
                'regex:/[a-z]/',     // Setidaknya satu huruf kecil
                'regex:/[A-Z]/',     // Setidaknya satu huruf besar
                'regex:/[0-9]/',     // Setidaknya satu angka
                'regex:/[@$!%*#?&]/', // Setidaknya satu karakter spesial
                'not_regex:/\s/',    // Tidak boleh mengandung spasi
                'not_regex:/\p{Lm}/', // Tidak boleh mengandung emoji
            ],
        ]);

        Log::info('Validation passed'); // Log setelah validasi berhasil

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            Log::info('Login successful for user: ' . $request->email);
            return redirect()->intended('/');
        } else {
            Log::info('Login failed for user: ' . $request->email);
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

}
