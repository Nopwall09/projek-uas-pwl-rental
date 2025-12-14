<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     * Jika sudah login → redirect sesuai role
     */
    public function showLogin()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect('/admin'); // Filament
            }

            if ($role === 'kasir') {
                return redirect()->route('kasir.dashboard');
            }
            

            return redirect()->route('login'); 
        }

        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect('/admin');
            }

            if ($role === 'kasir') {
                return redirect()->route('kasir.dashboard');
            }
            if ($role === 'user') {
                return redirect()->route('home');
            }

            return redirect()->route('home');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return redirect()->route('home');
        return view('home');
    }
    // Register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

}
