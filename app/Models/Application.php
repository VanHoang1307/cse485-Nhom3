<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [

    'student_id',
    'scholarship_program_id',
    'application_code',
    'apply_date',
    'status',
    'review_note'

    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function documents()
    {
        return $this->hasMany(ApplicationDocument::class);
    }
        public function scores()
    {
        return $this->hasMany(EvaluationScore::class);
    }
    public function rankingResult()
    {
        return $this->hasOne(RankingResult::class);
    }
    public function scholarshipProgram()
    {
    return $this->belongsTo(ScholarshipProgram::class);
    }
}
