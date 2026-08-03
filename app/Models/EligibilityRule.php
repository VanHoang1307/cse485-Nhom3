<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EligibilityRule extends Model
{

    protected $fillable = [
        'scholarship_program_id',
        'min_gpa',
        'min_credits',
        'allow_debt_subject',
        'note',
    ];



    public function scholarshipProgram(): BelongsTo
    {
        return $this->belongsTo(
            ScholarshipProgram::class
        );
    }

}