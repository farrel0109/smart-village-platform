<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Jika sudah login, langsung ke dashboard
        }

        return view('pages.auth.login');
    }

    // Proses autentikasi
    public function authenticate(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userStatus = Auth::user()->status;

            if ($userStatus === 'submitted') {
                Auth::logout();
                return back()->with('status_modal', 'submitted');
            }

            if ($userStatus === 'rejected') {
                Auth::logout();
                return back()->with('status_modal', 'rejected');
            }

            if ($userStatus === 'approved') {
                return redirect()->intended(route('dashboard'));
            }
        }

        return back()->with('status_modal', 'invalid');
    }

    // Logout user
    public function logout(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Tampilkan halaman register
    public function registerView()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('pages.auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role_id = 2; // Role default sebagai penduduk
        $user->status = 'submitted'; // Status default saat register
        $user->saveOrFail();

        return redirect('/')->with('success', 'Berhasil mendaftarkan akun, silakan menunggu persetujuan admin.');
    }
}
