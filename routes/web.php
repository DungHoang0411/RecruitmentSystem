<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ExportController;

Route::get('/', function () {
    return Auth::check() ? redirect('/job-posts') : redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
});

Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/job-posts', [JobPostController::class, 'index'])->name('job-posts.index');
    Route::get('/job-posts/create', [JobPostController::class, 'create'])->name('job-posts.create');
    Route::post('/job-posts', [JobPostController::class, 'store'])->name('job-posts.store');
    Route::get('/job-posts/{job_post}', [JobPostController::class, 'show'])->name('job-posts.show');
    Route::get('/job-posts/{job_post}/edit', [JobPostController::class, 'edit'])->name('job-posts.edit');
    Route::put('/job-posts/{job_post}', [JobPostController::class, 'update'])->name('job-posts.update');
    Route::delete('/job-posts/{job_post}', [JobPostController::class, 'destroy'])->name('job-posts.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{company}', [CompanyController::class, 'show'])->name('companies.show');
    Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

    Route::get('/export/job-posts', [ExportController::class, 'exportJobPosts'])->name('exports.job-posts');
    Route::get('/export/history', [ExportController::class, 'history'])->name('exports.history');
    Route::get('/export/download/{id}', [ExportController::class, 'download'])->name('exports.download');
});
