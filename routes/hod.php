<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HoD\HoDController;
use App\Http\Controllers\HoD\ThesisController as HoDThesisController;
use App\Http\Controllers\HoD\ThesisRequestsController as HoDThesisRequestsController;

Route::prefix('hod')->name('hod.')->middleware(['auth', 'role:hod'])->group(function () {

    Route::get('/dashboard', [HoDController::class, 'index'])->name('dashboard');

    // Thesis Routes
    Route::get('/thesis', [HoDThesisController::class, 'index'])->name('thesis.index');
    Route::get('/thesis/create', [HoDThesisController::class, 'create'])->name('thesis.create');
    Route::post('/thesis/store', [HoDThesisController::class, 'store'])->name('thesis.store');
    Route::get('/thesis/edit/{thesis}', [HoDThesisController::class, 'edit'])->name('thesis.edit');
    Route::put('/thesis/update/{thesis}', [HoDThesisController::class, 'update'])->name('thesis.update');
    Route::get('/thesis/view-pdf/{file}', [HoDThesisController::class, 'viewPDF'])->name('thesis.view-pdf');
    Route::delete('/thesis/destroy/{thesis}', [HoDThesisController::class, 'destroy'])->name('thesis.destroy');
    Route::get('/thesis/my-theses', [HoDThesisController::class, 'myTheses'])->name('thesis.my-theses');
    Route::get('/thesis/search', [HoDThesisController::class, 'search'])->name('thesis.search');
    Route::get('/thesis/download/{file}', [HoDThesisController::class, 'downloadPDF'])->name('thesis.download');

    // Thesis Requests Routes
    Route::get('/thesis-requests/index', [HoDThesisRequestsController::class, 'index'])->name('thesis_requests.index');
    Route::get('/thesis-requests/show/{thesisRequest}', [HoDThesisRequestsController::class, 'show'])->name('thesis_requests.show');
    Route::get('/thesis-requests/view-pdf/{file}', [HoDThesisRequestsController::class, 'viewRequestPDF'])->name('thesis_requests.view-request-pdf');
    Route::post('/thesis-requests/approve/{thesisRequest}', [HoDThesisRequestsController::class, 'approveRequest'])->name('thesis_requests.approve');
    Route::put('/thesis-requests/{thesisRequest}/reject', [HodThesisRequestsController::class, 'rejectRequest'])->name('thesis_requests.reject');
});
