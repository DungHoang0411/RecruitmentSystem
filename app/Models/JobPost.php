<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    /** @use HasFactory<\Database\Factories\JobPostFactory> */
    use HasFactory;
    protected $fillable = [
        'title', 'department', 'salary_min', 'salary_max', 'deadline', 'status'
    ];
}
