<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EvaluationScore;

class EvaluationScoreSeeder extends Seeder
{
    public function run(): void
    {
        EvaluationScore::create([
            'application_id' => 1,
            'criterion_id' => 1,
            'committee_id' => 1,
            'score' => 90,
            'comment' => 'Đạt yêu cầu'
        ]);
    }
}