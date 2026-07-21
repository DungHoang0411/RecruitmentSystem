<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobPost;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
}
