<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            StudentSeeder::class,
            ApplicationSeeder::class,
            ApplicationDocumentSeeder::class,
            EvaluationScoreSeeder::class,
            RankingResultSeeder::class,
            ScholarshipProgramSeeder::class,
            EligibilityRuleSeeder::class,
        ]);
    }
}