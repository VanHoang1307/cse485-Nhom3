<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationCommittee extends Model
{
    protected $table = 'evaluation_committees';

    protected $fillable = [
        'scholarship_program_id',
        'committee_name',
        'chairman',
        'decision_date',
        'status',
    ];

    public function scholarshipProgram(): BelongsTo
    {
        return $this->belongsTo(
            ScholarshipProgram::class,
            'scholarship_program_id'
        );
    }

    public function evaluationScores(): HasMany
    {
        return $this->hasMany(
            EvaluationScore::class,
            'committee_id'
        );
    }
}

