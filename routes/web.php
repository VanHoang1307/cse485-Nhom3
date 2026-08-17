<?php


use App\Models\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationDocumentController;
use App\Http\Controllers\EvaluationScoreController;
use App\Http\Controllers\RankingResultController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {

    return Application::with([
        'student',
        'documents',
        'scores',
        'rankingResult'
    ])->get();

});

Route::resource('students', StudentController::class)
    ->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ]);

Route::resource('applications', ApplicationController::class)
    ->only([
        'index',
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ]);
Route::resource('application_documents', ApplicationDocumentController::class);
Route::resource(
    'evaluation_scores',
    EvaluationScoreController::class
);
Route::resource(
    'ranking_results',
    RankingResultController::class
);