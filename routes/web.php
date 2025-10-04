<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class, 'index']);
Route::get('/login', [UserController::class, 'index']);
Route::post('/login', [UserController::class, 'authenticate']);