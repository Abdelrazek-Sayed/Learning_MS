<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Modules\Users\UserAPIController;

Route::post('login',  [UserAPIController::class, 'login'])->name('login');
Route::post('register',  [UserAPIController::class, 'register'])->name('register');

Route::get('logout',  [UserAPIController::class, 'logout'])->name('logout');
Route::get('profile',  [UserAPIController::class, 'profile'])->name('profile');
Route::get('profileEdit',  [UserAPIController::class, 'profileEdit'])->name('profileEdit');
