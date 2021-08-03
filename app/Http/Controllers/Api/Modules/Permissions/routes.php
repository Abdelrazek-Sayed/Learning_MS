<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Modules\Permissions\PermissionAPIController;

// // permissions route
Route::post('permmision_create',  [PermissionAPIController::class, 'create'])->name('permission.create');
Route::post('permmision_update',  [PermissionAPIController::class, 'update'])->name('permission.update');
Route::post('permmision_view',    [PermissionAPIController::class, 'view'])->name('permission.view');
Route::post('permmision_delete',  [PermissionAPIController::class, 'delete'])->name('permission.delete');
Route::post('permmision_index',        [PermissionAPIController::class, 'index'])->name('permission.all');
