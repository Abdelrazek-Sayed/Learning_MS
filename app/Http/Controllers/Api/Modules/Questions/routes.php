<?php

use App\Http\Controllers\Api\Modules\Questions\QuestionAPIController;
use Illuminate\Support\Facades\Route;

// // permissions route
Route::post('question_create',  [QuestionAPIController::class, 'create'])->name('question.create');
Route::post('question_update',  [QuestionAPIController::class, 'update'])->name('question.update');
Route::post('question_view',    [QuestionAPIController::class, 'view'])->name('question.view');
Route::post('question_delete',  [QuestionAPIController::class, 'delete'])->name('question.delete');
Route::post('question_all',        [QuestionAPIController::class, 'all'])->name('question.all');
