<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app'); // Đảm bảo `resources/views/index.blade.php` tồn tại
})->where('any', '.*');
