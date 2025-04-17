<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllowedStudent extends Model
{
    protected $fillable = [
        'student_id',
        'first_name',
        'last_name',
        'is_registered'
    ];
}
