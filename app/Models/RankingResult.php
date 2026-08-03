<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankingResult extends Model
{
        protected $fillable = [

        'application_id',
        'total_score',
        'ranking',
        'result'

    ];
        public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
