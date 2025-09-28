<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/tasks', [TaskController::class, 'getTasks']); // fetch all tasks
Route::post('/tasks', [TaskController::class, 'store']); // create tasks
Route::put('/tasks/{id}', [TaskController::class, 'update']); // update single task
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // delete task
