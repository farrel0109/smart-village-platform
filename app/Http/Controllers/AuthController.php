<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Default role for new users
     */
    private const DEFAULT_ROLE_NAME = 'user';

    /**
     * Show login page.
     */
    public function login()
    {
        return view('pages.auth.login');
    }

    /**
     * Handle authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->with('status_modal', 'invalid');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Check user status
        if ($user->status !== 'approved') {
            Auth::logout();
            return back()->with('status_modal', $user->status);
        }

        // Redirect based on role
        return $this->redirectBasedOnRole($user);
    }

    /**
     * Redirect user based on their role.
     */
    private function redirectBasedOnRole($user)
    {
        $roleName = $user->role?->name;

        return match($roleName) {
            'superadmin', 'admin' => redirect()->route('admin.dashboard'),
            'user' => redirect()->route('user.dashboard'),
            default => redirect()->route('landing'),
        };
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }

    /**
     * Show register page.
     */
    public function registerView()
    {
        $villages = Village::where('is_active', true)
            ->orderBy('regency')
            ->orderBy('name')
            ->get();

        return view('pages.auth.register', compact('villages'));
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'village_id' => ['required', 'exists:villages,id'],
        ]);

        // Get default role ID
        $defaultRoleId = Role::where('name', self::DEFAULT_ROLE_NAME)->value('id') ?? 3;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $defaultRoleId,
            'village_id' => $validated['village_id'],
            'status' => 'submitted',
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Silakan tunggu verifikasi dari admin desa.');
    }
}
