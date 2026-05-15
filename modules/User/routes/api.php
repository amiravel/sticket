<?php

use Modules\User\App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'store']);