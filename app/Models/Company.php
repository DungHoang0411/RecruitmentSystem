<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description'];

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }
}
