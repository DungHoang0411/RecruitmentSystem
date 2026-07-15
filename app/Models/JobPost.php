<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory, SoftDeletes;
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_post_tag');
    }

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'destination_country',
        'job_type',
        'visa_type',
        'headcount',
        'created_by',
        'category_id',
        'requirements',
        'benefits',
        'work_location',
        'salary_min',
        'salary_max',
        'salary_currency',
        'salary_period',
        'experience_years_min',
        'age_min',
        'age_max',
        'gender_preference',
        'published_at',
        'expired_at',
        'is_featured',
        'view_count',
        'application_count'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'expired_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
}
