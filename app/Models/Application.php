<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    protected $fillable = [
        'student_id',
        'scholarship_program_id',
        'application_code',
        'apply_date',
        'status',
        'review_note',
    ];

    /**
     * Hồ sơ thuộc về một sinh viên.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Hồ sơ thuộc về một chương trình học bổng.
     */
    public function scholarshipProgram(): BelongsTo
    {
        return $this->belongsTo(
            ScholarshipProgram::class,
            'scholarship_program_id'
        );
    }

    /**
     * Một hồ sơ có nhiều minh chứng.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(
            ApplicationDocument::class,
            'application_id'
        );
    }

    /**
     * Một hồ sơ có nhiều điểm đánh giá.
     */
    public function evaluationScores(): HasMany
    {
        return $this->hasMany(
            EvaluationScore::class,
            'application_id'
        );
    }

    /**
     * Một hồ sơ có một kết quả xếp hạng.
     */
    public function rankingResult(): HasOne
    {
        return $this->hasOne(
            RankingResult::class,
            'application_id'
        );
    }
}

