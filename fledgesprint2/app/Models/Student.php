<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'student_id',
        'password',
        'profile_picture',
        'cv',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
