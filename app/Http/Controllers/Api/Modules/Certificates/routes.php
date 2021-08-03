<?php

use App\Http\Controllers\Api\Modules\Questions\CertificateAPIController;
use Illuminate\Support\Facades\Route;

// // permissions route
Route::post('certificate_create',  [CertificateAPIController::class, 'create'])->name('certificate.create');
Route::post('certificate_update',  [CertificateAPIController::class, 'update'])->name('certificate.update');
Route::post('certificate_view',    [CertificateAPIController::class, 'view'])->name('certificate.view');
Route::post('certificate_delete',  [CertificateAPIController::class, 'delete'])->name('certificate.delete');
Route::post('certificate_all',        [CertificateAPIController::class, 'all'])->name('certificate.all');
