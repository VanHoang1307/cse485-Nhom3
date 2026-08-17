<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankingResult extends Model
{
    protected $fillable = [
        'application_id',
        'total_score',
        'rank',
    ];

    /**
     * Kết quả xếp hạng thuộc về một hồ sơ ứng tuyển
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}