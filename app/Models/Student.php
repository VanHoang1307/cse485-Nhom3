<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_code',
        'full_name',
        'gender',
        'date_of_birth',
        'faculty',
        'major',
        'class',
        'email',
        'phone',
        'gpa',
        'training_score',
        'status'
    ];
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}