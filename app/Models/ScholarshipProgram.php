<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScholarshipProgram extends Model
{
    protected $fillable = [
        'name',
        'description',
        'amount',
        'academic_year',
        'semester',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * Một chương trình có nhiều điều kiện xét.
     */
    public function eligibilityRules(): HasMany
    {
        return $this->hasMany(
            EligibilityRule::class,
            'scholarship_program_id'
        );
    }

    /**
     * Một chương trình có nhiều tiêu chí chấm điểm.
     */
    public function scoringCriteria(): HasMany
    {
        return $this->hasMany(
            ScoringCriterion::class,
            'scholarship_program_id'
        );
    }

    /**
     * Một chương trình có nhiều hội đồng xét duyệt.
     */
    public function evaluationCommittees(): HasMany
    {
        return $this->hasMany(
            EvaluationCommittee::class,
            'scholarship_program_id'
        );
    }

    /**
     * Một chương trình có nhiều hồ sơ đăng ký.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(
            Application::class,
            'scholarship_program_id'
        );
    }
}

