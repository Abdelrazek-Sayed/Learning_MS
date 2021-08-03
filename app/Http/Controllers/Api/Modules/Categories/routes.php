<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Modules\Categories\CategoryAPIController;

// // permissions route
Route::post('category_create',  [CategoryAPIController::class, 'create'])->name('category.create');
Route::post('category_update',  [CategoryAPIController::class, 'update'])->name('category.update');
Route::post('category_view',    [CategoryAPIController::class, 'view'])->name('category.view');
Route::post('category_delete',  [CategoryAPIController::class, 'delete'])->name('category.delete');
Route::post('category_index',   [CategoryAPIController::class, 'index'])->name('category.index');
