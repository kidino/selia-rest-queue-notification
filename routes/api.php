<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\VacancyApplicationController;

Route::get('/user', function (Request $request) {
    return [
        'status' => 'success',
        'data' => $request->user()
    ];
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum','ability:Admin'])->group(function () {

    Route::get('/users', [UserController::class, 'index']);
    // ->middleware(['throttle:2,1']);

    Route::get('/users/{id}', [UserController::class, 'show']);    
});

Route::middleware(['auth:sanctum', 'ability:API'])->group(function () {
    Route::get('/vacancies', [\App\Http\Controllers\API\VacancyController::class, 'index']);
    Route::get('/vacancies/{vacancy}', [\App\Http\Controllers\API\VacancyController::class, 'show']);
    Route::post('/vacancies/{vacancy}/apply', [\App\Http\Controllers\API\VacancyApplicationController::class, 'store']);
});




