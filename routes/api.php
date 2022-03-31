<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\StudentController;
use \App\Http\Controllers\Api\ClassstController;
use \App\Http\Controllers\Api\LectureController;
use \App\Http\Controllers\Api\PlanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/{student}',  [StudentController::class, 'show']);
Route::post('/student',  [StudentController::class, 'store']);
Route::put('/student/{student}', [StudentController::class, 'update']);
Route::delete('/student/{student}', [StudentController::class, 'destroy']);

Route::get('/classst', [ClassstController::class, 'index']);
Route::get('/classst/{classst}',  [ClassstController::class, 'show']);
Route::post('/classst',  [ClassstController::class, 'store']);
Route::put('/classst/{classst}', [ClassstController::class, 'update']);
Route::delete('/classst/{classst}', [ClassstController::class, 'destroy']);

Route::get('/lecture', [LectureController::class, 'index']);
Route::get('/lecture/{lecture}',  [LectureController::class, 'show']);
Route::post('/lecture',  [LectureController::class, 'store']);
Route::put('/lecture/{lecture}', [LectureController::class, 'update']);
Route::delete('/lecture/{lecture}', [LectureController::class, 'destroy']);

Route::get('/plan/{classst}',  [PlanController::class, 'show']);
Route::post('/plan',  [PlanController::class, 'store']);
Route::put('/plan/{plan}', [PlanController::class, 'update']);
Route::delete('/plan/{plan}', [PlanController::class, 'destroy']);


