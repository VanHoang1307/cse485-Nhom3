<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD

class ScholarshipProgram extends Model
{
    //
=======
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

>>>>>>> 8ee60937cae970876e6aa4aeb5da80c206e82860
}
