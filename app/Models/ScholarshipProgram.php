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


    public function eligibilityRules(): HasMany
    {
        return $this->hasMany(EligibilityRule::class);
    }

}
