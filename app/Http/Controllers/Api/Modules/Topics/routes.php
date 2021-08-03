<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Modules\Topics\TopicAPIController;

// // permissions route
Route::post('topic_create',  [TopicAPIController::class, 'create'])->name('topic.create');
Route::post('topic_update',  [TopicAPIController::class, 'update'])->name('topic.update');
Route::post('topic_view',    [TopicAPIController::class, 'view'])->name('topic.view');
Route::post('topic_delete',  [TopicAPIController::class, 'delete'])->name('topic.delete');
Route::post('topic_index',   [TopicAPIController::class, 'index'])->name('topic.all');



