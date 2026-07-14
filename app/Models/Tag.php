<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobPost;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function jobPosts()
    {
        return $this->belongsToMany(JobPost::class, 'job_post_tag', 'tag_id', 'job_post_id');
    }
}
