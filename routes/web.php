<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/login', [UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/profile', [UserController::class, 'show'])->middleware('auth');
Route::post('/logout', [UserController::class, 'logout']);

// Register
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/register', [UserController::class, 'store']);

// Main Page
Route::get('/', [ProductController::class, 'index'])->middleware('auth');

// Roles Page
Route::get('/seller', [ProductController::class, 'seller'])->middleware('auth', 'role:seller');
Route::get('/seller/create', [ProductController::class, 'create'])->middleware('auth', 'role:seller');
Route::post('/seller/create', [ProductController::class, 'store'])->middleware('auth', 'role:seller');
Route::get('/buyer', [UserController::class, 'buyer'])->middleware('auth', 'role:seller,buyer');