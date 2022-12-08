<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware('auth')->group(function () {

    Route::get('/', [AdminController::class, 'index']);
    Route::post('/delete', [AdminController::class, 'delete']);
    Route::post('/read', [AdminController::class, 'read']);

});

require __DIR__.'/auth.php';

Route::post('/setup', [AdminController::class, 'setup']);