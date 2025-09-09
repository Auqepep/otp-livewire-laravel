<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::view('/', 'welcome');

// Custom OTP Auth Routes
Route::view('login', 'auth.login')->name('login')->middleware('guest');
Route::view('register', 'auth.register')->name('register')->middleware('guest');

// Email verification route (for clickable links in emails)
Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->name('verification.verify')
    ->middleware(['signed', 'throttle:6,1']);

// Logout route
Route::post('logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// OTP Demo route
Route::get('otp-demo', function () {
    return view('livewire.examples.otp-demo');
})->name('otp.demo');

// Debug route for testing verification
Route::get('debug-verify/{id}/{hash}', function ($id, $hash) {
    $user = \App\Models\User::find($id);
    if (!$user) {
        return "User not found with ID: $id";
    }
    
    $expectedHash = sha1($user->email);
    
    return [
        'user_id' => $id,
        'provided_hash' => $hash,
        'expected_hash' => $expectedHash,
        'hash_matches' => hash_equals($hash, $expectedHash),
        'user_email' => $user->email,
        'is_verified' => $user->hasVerifiedEmail(),
    ];
})->name('debug.verify');

// Comment out the default auth routes since we're using custom OTP auth
// require __DIR__.'/auth.php';
