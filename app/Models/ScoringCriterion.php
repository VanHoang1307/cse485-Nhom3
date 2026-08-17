<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoringCriterion extends Model
{
    protected $table = 'scoring_criteria';

    protected $fillable = [
        'name',
        'description',
        'max_score',
        'weight',
    ];

    protected $casts = [
        'max_score' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    public function evaluationScores()
    {
        return $this->hasMany(
            EvaluationScore::class,
            'criterion_id'
        );
    }
}