<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {

        if (Auth::check()) {
            return redirect()->route('admin.dashboard.index');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $email = $request->email;

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $failed = cache()->get("login_failed_$email", 0);
        $lockedUntil = cache()->get("login_locked_$email");

        if ($lockedUntil && now()->lessThan($lockedUntil)) {

            $remainingSeconds = (int) now()->diffInSeconds($lockedUntil);

            return back()->with([
                'error' => "Akun terkunci sementara.",
                'lock_remaining' => $remainingSeconds
            ]);
        }

        if (Auth::attempt($credentials)) {

            cache()->forget("login_failed_$email");
            cache()->forget("login_locked_$email");

            $request->session()->regenerate();
            return redirect()->route('admin.dashboard.index');
        }

        $failed++;
        cache()->put("login_failed_$email", $failed, 3600); 

        $lockMinutes = 0;

        if ($failed >= 5 && $failed < 10) {
            $lockMinutes = 1;
        } elseif ($failed >= 10 && $failed < 15) {
            $lockMinutes = 5;
        } elseif ($failed >= 15 && $failed < 20) {
            $lockMinutes = 30;
        } elseif ($failed >= 20) {
            $lockMinutes = 60;
        }

        if ($lockMinutes > 0) {
            $lockedUntil = now()->addMinutes($lockMinutes);

            cache()->put("login_locked_$email", $lockedUntil, $lockMinutes * 60);

            return back()->with([
                'error' => "Terlalu banyak percobaan gagal. Akun terkunci selama $lockMinutes menit.",
                'lock_remaining' => $lockMinutes * 60
            ]);
        }

        return back()->with('error', 'Email atau password salah!');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
