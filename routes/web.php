<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/login', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);

// Register
Route::get('/register', [UserController::class, 'create']);
Route::post('/register', [UserController::class, 'store']);

// Main Page
Route::get('/', [ProductController::class, 'index']);