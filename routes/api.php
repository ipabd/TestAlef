<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\StudentController;
use \App\Http\Controllers\Api\ClassstController;
use \App\Http\Controllers\Api\LectureController;

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


Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::post('/student', [StudentController::class, 'store']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

Route::get('/classst', [ClassstController::class, 'index']);
Route::get('/classst/{id}', [ClassstController::class, 'show']);
Route::post('/classst', [ClassstController::class, 'store']);
Route::put('/classst/{id}', [ClassstController::class, 'update']);
Route::delete('/classst/{id}', [ClassstController::class, 'destroy']);

Route::get('/lecture', [LectureController::class, 'index']);
Route::get('/lecture/{id}', [LectureController::class, 'show']);
Route::post('/lecture', [LectureController::class, 'store']);
Route::put('/lecture/{id}', [LectureController::class, 'update']);
Route::delete('/lecture/{id}', [LectureController::class, 'destroy']);


