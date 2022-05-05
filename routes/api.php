<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::apiResource('/v1/contact', ContactController::class)->only([
    'store'
]);