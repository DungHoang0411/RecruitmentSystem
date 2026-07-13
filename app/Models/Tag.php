<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function jobPosts()
    {
        return $this->belongsToMany(JobPost::class, 'job_post_tag');
    }
}
