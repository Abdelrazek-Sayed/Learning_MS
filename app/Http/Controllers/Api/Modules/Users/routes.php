<?php

use App\Http\Controllers\Api\Modules\Users\UserAPIController;

Route::post('login',  [UserAPIController::class, 'login'])->name('login');
Route::post('register',  [UserAPIController::class, 'register'])->name('register');
