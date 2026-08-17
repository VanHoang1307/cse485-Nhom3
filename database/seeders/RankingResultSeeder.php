<?php

namespace Database\Seeders;

use App\Models\RankingResult;
use Illuminate\Database\Seeder;

class RankingResultSeeder extends Seeder
{
    public function run(): void
    {
        RankingResult::truncate();

        RankingResult::create([
            'application_id' => 1,
            'total_score' => 95,
            'ranking' => 1,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 2,
            'total_score' => 90,
            'ranking' => 2,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 3,
            'total_score' => 85,
            'ranking' => 3,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 4,
            'total_score' => 80,
            'ranking' => 4,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 5,
            'total_score' => 75,
            'ranking' => 5,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 6,
            'total_score' => 70,
            'ranking' => 6,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 7,
            'total_score' => 65,
            'ranking' => 7,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 8,
            'total_score' => 60,
            'ranking' => 8,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 9,
            'total_score' => 55,
            'ranking' => 9,
            'result' => 'Qualified',
        ]);

        RankingResult::create([
            'application_id' => 10,
            'total_score' => 50,
            'ranking' => 10,
            'result' => 'Qualified',
        ]);
    }
}

