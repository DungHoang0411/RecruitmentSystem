<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;

Route::resource('job-posts', JobPostController::class);

Route::get('/', function () {
    return redirect()->route('job-posts.index');
});
