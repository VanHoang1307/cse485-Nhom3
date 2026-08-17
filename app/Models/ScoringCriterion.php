<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScoringCriterion extends Model
{
    protected $table = 'scoring_criteria';

    protected $fillable = [
        'scholarship_program_id',
        'criteria_name',
        'max_score',
        'weight',
        'description',
    ];

    protected $casts = [
        'max_score' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    /**
     * Tiêu chí thuộc chương trình học bổng nào.
     */
    public function scholarshipProgram(): BelongsTo
    {
        return $this->belongsTo(
            ScholarshipProgram::class,
            'scholarship_program_id'
        );
    }

    /**
     * Tiêu chí có nhiều điểm đánh giá.
     */
    public function evaluationScores()
    {
        return $this->hasMany(
            EvaluationScore::class,
            'criterion_id'
        );
    }
}