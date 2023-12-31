<?php

use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route groups for animals
Route::get('/animals', [AnimalsController::class, 'index']);
Route::post('/animals', [AnimalsController::class, 'create']);
Route::put('/animals/{id}', [AnimalsController::class, 'update']);
Route::delete('/animals/{id}', [AnimalsController::class, 'destroy']);

// route groups for students
Route::get('/students', [StudentController::class, 'index']);
// Route::get('/students', [StudentController::class, 'index'])->middleware('auth:sanctum');
Route::post('/students', [StudentController::class, 'store']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);

// route auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);