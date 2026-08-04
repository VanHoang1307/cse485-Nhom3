<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipProgramController;
use App\Http\Controllers\EligibilityRuleController;

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