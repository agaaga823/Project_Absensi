<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.pagelogin');
    }

    public function login(Request $request)
    {

        $request->validate([
    'email' => 'required|email',
    'password' => 'required|string|min:8',
]);


        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Cek role user
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->intended('/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Role tidak dikenali.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    } //
}

