<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',

        ], [
            'name.required' => 'Nama harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.confirmed' => 'Password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully registered',
            'user' => $user->only(['id', 'name', 'email'])
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged in',
            'token' => $token,
            'user' => $user->only(['id', 'name', 'email'])
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['success' => true, 'message' => 'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user()->only('id', 'name', 'email'));
    }
}
