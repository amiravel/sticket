<?php

use Modules\User\App\Http\Controllers\LoginController;
use Modules\User\App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth:sanctum');