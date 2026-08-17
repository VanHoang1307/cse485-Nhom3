<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoringCriterion extends Model
{
    protected $fillable = [
        'scholarship_program_id',
        'criteria_name',
        'max_score',
        'weight',
        'description',
    ];

    public function scholarshipProgram(): BelongsTo
    {
        return $this->belongsTo(
            ScholarshipProgram::class,
            'scholarship_program_id'
        );
    }
}