<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Backend\ProductCategoryController;

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

// Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/tasks', [TaskController::class, 'store']);

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/api/tasks', [TaskController::class, 'getTasks']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::get('/tasks', [TaskController::class, 'getTasks']);


// product-categories 
Route::post('/product-categories/multiple', [ProductCategoryController::class, 'storeMultiple'])->name('product-categories.store-multiple');
Route::get('/product-categories', [ProductCategoryController::class, 'index'])->name('product-categories.index');
Route::post('/product-categories', [ProductCategoryController::class, 'store'])->name('product-categories.store');
Route::get('/product-categories/{id}', [ProductCategoryController::class, 'edit'])->name('product-categories.edit');
Route::post('/product-categories/{id}', [ProductCategoryController::class, 'update'])->name('product-categories.update');
Route::post('product-categories/delete/{id}', [ProductCategoryController::class, 'delete'])->name('product-categories.delete');
// web.php
Route::post('/product-categories/multiple', [ProductCategoryController::class, 'storeMultiple'])->name('product-categories.store-multiple');
