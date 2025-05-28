<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'indexRegister'])->name('auth.register');
    Route::get('/login', [AuthController::class, 'indexLogin'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('verify-otp', [OTPController::class, 'show'])->name('otp.show');
    Route::post('verify-otp', [OTPController::class, 'verify'])->name('otp.verify');
    Route::post('send-otp', [OTPController::class, 'send'])->name('otp.send');
    Route::post('resend-otp', [OTPController::class, 'resend'])->name('otp.resend');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
});
