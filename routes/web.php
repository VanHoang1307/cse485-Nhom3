<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});
use App\Models\Application;

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