<?php

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\ThesisController as StudentThesisController;
use App\Http\Controllers\Student\ThesisRequestsController as StudentThesisRequestsController;
use App\Http\Controllers\Student\SavedThesisController as StudentSaveThesisController;
use Illuminate\Support\Facades\Route;

// student routes
Route::prefix('student')->name('student.')->middleware(['auth', 'role:student'])->group(function () {

    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');

    // thesis routes
    Route::get('/thesis', [StudentThesisController::class, 'index'])->name('thesis.index');
    Route::get('/thesis/view-pdf/{file}', [StudentThesisController::class, 'viewPDF'])->name('thesis.view-pdf');
    Route::get('/thesis/my-theses', [StudentThesisController::class, 'myTheses'])->name('thesis.my-theses');
    Route::get('/thesis/search', [StudentThesisController::class, 'search'])->name('thesis.search');
    Route::get('/thesis/download/{file}', [StudentThesisController::class, 'downloadPDF'])->name('thesis.download');
    //view_history for student that record their thesis that they viewed
    Route::get('/thesis/view_history',[StudentThesisController::class, 'history'])->name('thesis.view_history');
    Route::get('/thesis/{thesis}', [StudentThesisController::class, 'show'])->name('thesis.show');

    // thesis requests routes
    Route::get('/thesis-requests/index', [StudentThesisRequestsController::class, 'index'])->name('thesis_requests.index');
    Route::get('/thesis-requests/create', [StudentThesisRequestsController::class, 'create'])->name('thesis_requests.create');
    Route::post('/thesis-requests/store', [StudentThesisRequestsController::class, 'store'])->name('thesis_requests.store');
    Route::get('/thesis-requests/show/{thesisRequest}', [StudentThesisRequestsController::class, 'show'])->name('thesis_requests.show');
    Route::get('/thesis-requests/view-pdf/{file}', [StudentThesisRequestsController::class, 'viewRequestPDF'])->name('thesis_requests.view-request-pdf');

    //Thesis rejected from HoD or Admin
    Route::get('/thesis/{thesisRequest}/rejected', [StudentThesisRequestsController::class, 'rejected'])->name('thesis_requests.rejected');

    //Thesis rejected need to resubmit again
    Route::put('/thesis/{thesisRequest}/resubmit', [StudentThesisRequestsController::class, 'resubmit'])->name('thesis_requests.resubmit');

    //Saved Thesis
    Route::get('/saved_thesis/index', [StudentSaveThesisController::class, 'index'])->name('saved_thesis.index');
    Route::post('/saved_thesis/store/{thesis}', [StudentSaveThesisController::class, 'store'])->name('saved_thesis.store');
    Route::delete('/saved_thesis/delete/{thesis}', [StudentSaveThesisController::class, 'destroy'])->name('saved_thesis.destroy');
});
