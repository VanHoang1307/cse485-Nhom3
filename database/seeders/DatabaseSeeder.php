<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
>>>>>>> 8ee60937cae970876e6aa4aeb5da80c206e82860
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
<<<<<<< HEAD
    use WithoutModelEvents;

=======
>>>>>>> 8ee60937cae970876e6aa4aeb5da80c206e82860
    /**
     * Seed the application's database.
     */
=======
>>>>>>> c63bd8db062e2b0a26835be02a104358fb4812dd
    public function run(): void
    {
        $this->call([
<<<<<<< HEAD
            StudentSeeder::class,
            ApplicationSeeder::class,
            ApplicationDocumentSeeder::class,
            EvaluationScoreSeeder::class,
            RankingResultSeeder::class,
        ]);
    }
    
}
=======
            ScholarshipProgramSeeder::class,
            EligibilityRuleSeeder::class,
        ]);
    }
}
>>>>>>> 8ee60937cae970876e6aa4aeb5da80c206e82860
