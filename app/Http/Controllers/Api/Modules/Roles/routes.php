<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Modules\Roles\RoleAPIController;

// // roles route
Route::post('role_create',  [RoleAPIController::class, 'create'])->name('role.create');
Route::post('role_update',  [RoleAPIController::class, 'update'])->name('role.update');
Route::post('role_view',    [RoleAPIController::class, 'view'])->name('role.view');
Route::post('role_delete',  [RoleAPIController::class, 'delete'])->name('role.delete');
Route::post('role_index',        [RoleAPIController::class, 'index'])->name('role.all');



