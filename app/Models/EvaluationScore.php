<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationScore extends Model
{
    protected $table = 'evaluation_scores';

    protected $fillable = [
        'application_id',
        'criterion_id',
        'committee_id',
        'score',
        'comment',
    ];

    protected $casts = [
        'score' => 'decimal:2',
    ];

    /**
     * Điểm thuộc hồ sơ nào
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Điểm thuộc tiêu chí nào
     */
    public function criterion()
    {
        return $this->belongsTo(ScoringCriterion::class);
    }

    /**
     * Điểm do hội đồng nào chấm
     */
    public function committee()
    {
        return $this->belongsTo(EvaluationCommittee::class);
    }
    public function evaluationScores()
{
    return $this->hasMany(EvaluationScore::class);
}
}