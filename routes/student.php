<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\ThesisController as StudentThesisController;
use App\Http\Controllers\Student\ThesisRequestsController as StudentThesisRequestsController;

// student routes
Route::prefix('student')->name('student.')->middleware(['auth', 'role:student'])->group(function () {

    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');

    // thesis routes
    Route::get('/thesis', [StudentThesisController::class, 'index'])->name('thesis.index');
    Route::get('/thesis/view-pdf/{file}', [StudentThesisController::class, 'viewPDF'])->name('thesis.view-pdf');
    Route::get('/thesis/my-theses', [StudentThesisController::class, 'myTheses'])->name('thesis.my-theses');
    Route::get('/thesis/search', [StudentThesisController::class, 'search'])->name('thesis.search');
    Route::get('/thesis/download/{file}', [StudentThesisController::class, 'downloadPDF'])->name('thesis.download');

    // thesis requests routes
    Route::get('/thesis-requests/index', [StudentThesisRequestsController::class, 'index'])->name('thesis_requests.index');
    Route::get('/thesis-requests/create', [StudentThesisRequestsController::class, 'create'])->name('thesis_requests.create');
    Route::post('/thesis-requests/store', [StudentThesisRequestsController::class, 'store'])->name('thesis_requests.store');
    Route::get('/thesis-requests/show/{thesisRequest}', [StudentThesisRequestsController::class, 'show'])->name('thesis_requests.show');
    Route::get('/thesis-requests/view-pdf/{file}', [StudentThesisRequestsController::class, 'viewRequestPDF'])->name('thesis_requests.view-request-pdf');
});
