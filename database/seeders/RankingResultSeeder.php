<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RankingResult;

class RankingResultSeeder extends Seeder
{
    public function run(): void
    {
        RankingResult::create([
            'application_id' => 1,
            'total_score' => 90,
            'ranking' => 1,
            'result' => 'Qualified'
        ]);
    }
}