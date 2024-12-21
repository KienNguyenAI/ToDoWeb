<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index']);

Route::get('/users/{id}/tasks', function ($id) {
    $user = User::with(['tasks.list', 'tasks.tag'])->find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return $user->tasks;
});
