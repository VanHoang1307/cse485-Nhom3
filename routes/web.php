<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScholarshipProgramController;


Route::get('/', function () {
    return view('welcome');
});


Route::resource(
    'scholarships',
    ScholarshipProgramController::class
);
use App\Http\Controllers\EligibilityRuleController;


Route::resource(
    'eligibility-rules',
    EligibilityRuleController::class
);