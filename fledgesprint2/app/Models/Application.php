<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'student_id',
        'message',
        'cv_path', // path to uploaded CV if applicable
    ];

    // 🔗 Link to the job this application belongs to
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // 🔗 Link to the student who applied (assumes users table contains students too)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
