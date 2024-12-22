<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

Route::get('/{any}', function () {
    return view('app'); // Đảm bảo `resources/views/index.blade.php` tồn tại
})->where('any', '.*');
