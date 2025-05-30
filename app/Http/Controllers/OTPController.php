<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OTPController extends Controller
{
    public function show(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
        ], [
            'email.exists' => 'User does not exist.',
        ]);

        $user = User::find($request->user);
        return view('auth.verify-otp', compact('user'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'otp_code' => 'required|numeric|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !$user->otp_code || now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['error' => 'OTP tidak valid atau telah kadaluarsa.'])->withInput();
        }

        if ($user->otp_code != $request->otp_code) {
            return back()->withErrors(['error' => 'OTP salah.'])->withInput();
        }

        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route('dashboard')->with('message', 'OTP berhasil diverifikasi.');
    }

    public function send(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users',
            ],
            [
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Email tidak valid.',
                'email.exists' => 'Email tidak terdaftar.',
            ]
        );
        $user = User::where('email', $request->email)->first();


        if ($user->otp_code) {
            if ($user->otp_code && now()->lt($user->otp_expires_at)) {
                return back()->withErrors(['error' => 'OTP belum kadaluarsa.'])->withInput();
            }

            if ($user->otp_code && now()->gt($user->otp_expires_at)) {
                $user->otp_code = null;
                $user->otp_expires_at = null;
                $user->save();
            }
        }

        $otp_code = rand(100000, 999999);
        $user->otp_code = $otp_code;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new SendOtpMail($otp_code, $user));

        return view('auth.verify-otp');
    }
}
