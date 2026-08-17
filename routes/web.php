<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipProgramController;
use App\Http\Controllers\EligibilityRuleController;
use App\Http\Controllers\ScoringCriterionController;
use App\Http\Controllers\EvaluationCommitteeController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource(
    'scholarships',
    ScholarshipProgramController::class
);

Route::resource(
    'eligibility-rules',
    EligibilityRuleController::class
);

Route::resource(
    'scoring-criteria',
    ScoringCriterionController::class
);

Route::resource(
    'evaluation-committees',
    EvaluationCommitteeController::class
);