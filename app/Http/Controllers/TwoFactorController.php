<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TwoFactorController extends Controller
{
    /**
     * Show 2FA settings page.
     */
    public function index()
    {
        $user = auth()->user();
        
        return view('pages.profile.two-factor', [
            'enabled' => $user->two_factor_enabled,
        ]);
    }

    /**
     * Enable 2FA for the user.
     */
    public function enable(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = auth()->user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password tidak valid.');
        }

        // Generate a simple 6-digit secret (in production, use a proper TOTP library)
        $secret = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'two_factor_secret' => bcrypt($secret),
            'two_factor_enabled' => true,
            'two_factor_confirmed_at' => now(),
        ]);

        // In a real app, you'd show a QR code or send this via email
        // For now, we'll just show the secret once
        session(['2fa_secret_shown' => $secret]);

        return back()->with('success', "2FA berhasil diaktifkan. Kode rahasia Anda: {$secret}");
    }

    /**
     * Disable 2FA for the user.
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password tidak valid.');
        }

        $user->update([
            'two_factor_secret' => null,
            'two_factor_enabled' => false,
            'two_factor_confirmed_at' => null,
        ]);

        return back()->with('success', '2FA berhasil dinonaktifkan.');
    }

    /**
     * Show 2FA verification page (during login).
     */
    public function showVerify()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }

        return view('pages.auth.two-factor-verify');
    }

    /**
     * Verify 2FA code during login.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $userId = session('2fa_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);
        if (!$user) {
            session()->forget('2fa_user_id');
            return redirect()->route('login');
        }

        // Verify the code (simplified - in production use TOTP)
        // For now, just check if it matches the stored hash
        if (!Hash::check($request->code, $user->two_factor_secret)) {
            return back()->with('error', 'Kode verifikasi tidak valid.');
        }

        // Clear the 2FA session and log the user in
        session()->forget('2fa_user_id');
        auth()->login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
    }
}
