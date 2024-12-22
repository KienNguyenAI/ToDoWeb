<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TaskController;
// use App\Http\Controllers\ListController;
// use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

// Route::apiResource('tasks', TaskController::class);
// Route::apiResource('lists', ListController::class);
// Route::apiResource('tags', TagController::class);
// Route::post('/users', [UserController::class, 'store']);

Route::middleware('api')->get('/users', [UserController::class, 'index']);
