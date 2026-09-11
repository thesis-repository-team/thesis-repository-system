<?php

use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\SavedThesisController as StudentSaveThesisController;
use App\Http\Controllers\Student\ThesisController as StudentThesisController;
use App\Http\Controllers\Student\ThesisRequestsController as StudentThesisRequestsController;
use Illuminate\Support\Facades\Route;

// Student & Guest routes (shared routes)
Route::prefix('student')->name('student.')->middleware(['auth', 'role:student,guest'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Thesis
    Route::get('/thesis', [StudentThesisController::class, 'index'])->name('thesis.index');
    Route::get('/thesis/view-pdf/{file}', [StudentThesisController::class, 'viewPDF'])->name('thesis.view-pdf');
    Route::get('/thesis/search', [StudentThesisController::class, 'search'])->name('thesis.search');
    Route::get('/thesis/download/{file}', [StudentThesisController::class, 'downloadPDF'])->name('thesis.download');
    Route::get('/thesis/view_history', [StudentThesisController::class, 'history'])->name('thesis.view_history');

    // Saved Thesis
    Route::get('/saved_thesis/index', [StudentSaveThesisController::class, 'index'])->name('saved_thesis.index');
    Route::post('/saved_thesis/store/{thesis}', [StudentSaveThesisController::class, 'store'])->name('saved_thesis.store');
    Route::delete('/saved_thesis/delete/{thesis}', [StudentSaveThesisController::class, 'destroy'])->name('saved_thesis.destroy');

    // Student-only routes
    Route::middleware(['verified', 'role:student'])->group(function () {
        // My Thesis
        Route::get('/thesis/my-theses', [StudentThesisController::class, 'myTheses'])->name('thesis.my-theses');

        // Thesis Requests
        Route::get('/thesis-requests/index', [StudentThesisRequestsController::class, 'index'])->name('thesis_requests.index');
        Route::get('/thesis-requests/create', [StudentThesisRequestsController::class, 'create'])->name('thesis_requests.create');
        Route::post('/thesis-requests/store', [StudentThesisRequestsController::class, 'store'])->name('thesis_requests.store');
        Route::get('/thesis-requests/show/{thesisRequest}', [StudentThesisRequestsController::class, 'show'])->name('thesis_requests.show');
        Route::get('/thesis-requests/view-pdf/{file}', [StudentThesisRequestsController::class, 'viewRequestPDF'])->name('thesis_requests.view-request-pdf');

        // Rejected Thesis
        Route::get('/thesis/{thesisRequest}/rejected', [StudentThesisRequestsController::class, 'rejected'])->name('thesis_requests.rejected');

        // Resubmit Rejected Thesis
        Route::put('/thesis/{thesisRequest}/resubmit', [StudentThesisRequestsController::class, 'resubmit'])->name('thesis_requests.resubmit');

        Route::get('/thesis/{thesis}', [StudentThesisController::class, 'show'])->name('thesis.show');
    });
});
