<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Fronted\HomeController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductSubCategoryController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

//auth
Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/registration', [AuthController::class, 'registrationPost'])->name('registrationPost');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('loginPost');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->get('/home', [HomeController::class, 'index'])->name('home.index');



    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');

    //product-categories 
    // Route::get('/product-categories', [ProductCategoryController::class, 'index'])->name('product-categories.index');
    // Route::post('/product-categories', [ProductCategoryController::class, 'store'])->name('product-categories.store');
    // Route::get('/product-categories/{id}', [ProductCategoryController::class, 'edit'])->name('product-categories.edit');
    // Route::post('/product-categories/{id}', [ProductCategoryController::class, 'update'])->name('product-categories.update');
    // Route::post('product-categories/delete/{id}', [ProductCategoryController::class, 'delete'])->name('product-categories.delete');

    //product-sub-categories 
    Route::get('/product-sub-categories', [ProductSubCategoryController::class, 'index'])->name('product-sub-categories.index');
    Route::post('/product-sub-categories', [ProductSubCategoryController::class, 'store'])->name('product-sub-categories.store');
    Route::get('/product-sub-categories/{id}', [ProductSubCategoryController::class, 'edit'])->name('product-sub-categories.edit');
    Route::post('/product-sub-categories/{id}', [ProductSubCategoryController::class, 'update'])->name('product-sub-categories.update');
    Route::post('product-sub-categories/delete/{id}', [ProductSubCategoryController::class, 'delete'])->name('product-sub-categories.delete');

    //Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('products/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.details');


    //product-categories 
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    // Route::get('/tasks/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    // Route::post('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::post('tasks/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');

    // Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');


