<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\AuthController;

Route::resource('job-posts', JobPostController::class);

Route::get('/', function () {
    return redirect()->route('job-posts.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->middleware('throttle:5,1')->name('login.process');

    Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
});
