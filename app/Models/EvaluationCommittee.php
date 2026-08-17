<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EvaluationCommittee extends Model
{
    protected $table = 'evaluation_committees';

    protected $fillable = [
        'name',
        'description',
    ];

    public function evaluationScores(): HasMany
    {
        return $this->hasMany(
            EvaluationScore::class,
            'committee_id'
        );
    }
}