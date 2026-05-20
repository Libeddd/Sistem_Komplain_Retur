<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s\.\,\-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/@gmail\.com$/'],
            'password' => 'required|string|min:3',
        ], [
            'name.regex' => 'Nama hanya boleh mengandung huruf, spasi, titik, dan koma.',
            'email.regex' => 'Email harus menggunakan domain @gmail.com.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect('/dashboard');
        }

        return redirect('/home');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            }

            return redirect('/home');
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang diberikan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
