<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScholarshipProgramController;
use App\Http\Controllers\EligibilityRuleController;
use App\Http\Controllers\ScoringCriterionController;
use App\Http\Controllers\EvaluationCommitteeController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationDocumentController;
use App\Http\Controllers\EvaluationScoreController;
use App\Http\Controllers\RankingResultController;


/*
|--------------------------------------------------------------------------
| Trang tổng quan
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('layouts.dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| Module 1: Quản lý học bổng
|--------------------------------------------------------------------------
*/

// Đóng chương trình học bổng
Route::patch(
    '/scholarships/{id}/close',
    [ScholarshipProgramController::class, 'close']
)->name('scholarships.close');

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


/*
|--------------------------------------------------------------------------
| Module 2: Quản lý hồ sơ xét học bổng
|--------------------------------------------------------------------------
*/

Route::resource(
    'students',
    StudentController::class
);

Route::resource(
    'applications',
    ApplicationController::class
);

Route::resource(
    'application-documents',
    ApplicationDocumentController::class
);


/*
|--------------------------------------------------------------------------
| Quản lý chấm điểm hồ sơ
|--------------------------------------------------------------------------
*/

// Lấy tiêu chí và hội đồng
// thuộc chương trình học bổng của hồ sơ
Route::get(
    '/evaluation-scores/application/{application}/data',
    [EvaluationScoreController::class, 'getApplicationData']
)->name('evaluation-scores.application-data');

// CRUD điểm đánh giá
Route::resource(
    'evaluation-scores',
    EvaluationScoreController::class
);


/*
|--------------------------------------------------------------------------
| Quản lý kết quả xếp hạng
|--------------------------------------------------------------------------
*/

Route::resource(
    'ranking-results',
    RankingResultController::class
);