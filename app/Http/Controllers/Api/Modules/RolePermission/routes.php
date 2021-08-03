<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Modules\Roles\RolePermissionAPIController;

// // roles route
Route::post('role_permission_create',  [RolePermissionAPIController::class, 'create'])->name('role_permission.create');
Route::post('role_permission_update',  [RolePermissionAPIController::class, 'update'])->name('role_permission.update');
Route::post('role_permission_view',    [RolePermissionAPIController::class, 'view'])->name('role_permission.view');
Route::post('role_permission_delete',  [RolePermissionAPIController::class, 'delete'])->name('role_permission.delete');
Route::post('role_permission_index',   [RolePermissionAPIController::class, 'index'])->name('role_permission.all');



// <?php

// use App\Http\Controllers\Api\Modules\RolesPermisions\RolePermisionAPIController;


// use Illuminate\Support\Facades\Route;


// Route::post('rolespermission/create',[RolePermisionAPIController::class,'store']);

// Route::get('rolespermission',[RolePermisionAPIController::class,'index']);

// Route::get('rolespermission/{id}',[RolePermisionAPIController::class,'show']);

// Route::post('rolespermission/{id}/edit',[RolePermisionAPIController::class,'update']);

// Route::post('rolespermission/{id}/delete',[RolePermisionAPIController::class,'destroy']);
