<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function application(): BelongsTo
    {
        return $this->belongsTo(
            Application::class,
            'application_id'
        );
    }

    /**
     * Điểm thuộc tiêu chí nào
     */
    public function criterion(): BelongsTo
    {
        return $this->belongsTo(
            ScoringCriterion::class,
            'criterion_id'
        );
    }

    /**
     * Điểm do hội đồng nào chấm
     */
    public function committee(): BelongsTo
    {
        return $this->belongsTo(
            EvaluationCommittee::class,
            'committee_id'
        );
    }
}