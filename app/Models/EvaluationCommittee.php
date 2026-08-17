<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationCommittee extends Model
{
    protected $fillable = [
        'scholarship_program_id',
        'committee_name',
        'chairman',
        'decision_date',
        'status',
    ];

    public function scholarshipProgram()
    {
        return $this->belongsTo(
            ScholarshipProgram::class,
            'scholarship_program_id'
        );
    }
}