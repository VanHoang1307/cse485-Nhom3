<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\EvaluationScore;
use App\Models\ScoringCriterion;
use App\Models\EvaluationCommittee;

class EvaluationScoreSeeder extends Seeder
{
    public function run(): void
    {
        $application = Application::first();
        $criterion = ScoringCriterion::first();
        $committee = EvaluationCommittee::first();

        EvaluationScore::create([
            'application_id' => $application->id,
            'criterion_id' => $criterion->id,
            'committee_id' => $committee->id,
            'score' => 90,
            'comment' => 'Đạt yêu cầu',
        ]);
    }
}