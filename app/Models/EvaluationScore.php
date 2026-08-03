<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationScore extends Model
{
        protected $fillable = [

            'application_id',
            'criterion_id',
            'committee_id',
            'score',
            'comment'
        ];
        public function application()
    {
        return $this->belongsTo(Application::class);
    }
        public function criterion()
    {
        return $this->belongsTo(ScoringCriteria::class,'criterion_id');
    }
        public function committee()
    {
        return $this->belongsTo(EvaluationCommittee::class,'committee_id');
    }
}
