<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController; 

Route::get('/', function () {
   return redirect()->route('job-posts.index');
});

// Đăng ký toàn bộ route CRUD (index, create, store, show, edit, update, destroy)
Route::resource('job-posts', JobPostController::class);