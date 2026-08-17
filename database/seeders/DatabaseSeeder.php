<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            ScholarshipProgramSeeder::class,
            EligibilityRuleSeeder::class,
            ScoringCriterionSeeder::class,
            EvaluationCommitteeSeeder::class,

            StudentSeeder::class,
            ApplicationSeeder::class,
            ApplicationDocumentSeeder::class,
            EvaluationScoreSeeder::class,
            RankingResultSeeder::class,
        ]);
    }
}