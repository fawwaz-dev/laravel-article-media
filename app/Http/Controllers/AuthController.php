<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function indexRegister()
    {
        return view('auth.register');
    }
    public function indexLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'terms' => 'required|accepted',
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
            'terms.required' => 'You must accept the Terms and Conditions.',
            'terms.accepted' => 'You must accept the Terms and Conditions.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $otp_code = mt_rand(100000, 999999);
        $user->otp_code = $otp_code;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new SendOtpMail($otp_code, $user));

        return redirect()->route('otp.show', ['email' => $user->email])->with('success', 'Registrasi berhasil. Silakan verifikasi OTP.');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ],
            [
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal 8 karakter.',
            ]
        );

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'error' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
