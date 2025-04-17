<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'job_type',
        'working_hours',
        'location',
        'pay_rate',
        'description'
    ];

    // Optional: Cast attributes to specific types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Optional: Add scopes for common filters
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeJobType($query, $jobType)
    {
        return $query->where('job_type', $jobType);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
