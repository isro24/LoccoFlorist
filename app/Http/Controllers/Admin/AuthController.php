<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = trim($validated['email']);
        $password = $validated['password'];

        $admin = Admin::whereRaw('BINARY email = ?', [$email])->first();

        if ($admin && Hash::check($password, $admin->password)) {
            Auth::login($admin);
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard.index');
        }

        return back()
            ->withInput(['email' => $email])
            ->with('error', 'Email atau password salah!');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Berhasil logout.');
    }
}
