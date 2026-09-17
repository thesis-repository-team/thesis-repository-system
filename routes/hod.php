<?php

use App\Http\Controllers\HoD\DashboardController as HoDDashboardController;
use App\Http\Controllers\HoD\StudentController as HoDStudentController;
use App\Http\Controllers\HoD\ThesisController as HoDThesisController;
use App\Http\Controllers\HoD\ThesisRequestsController as HoDThesisRequestsController;
use Illuminate\Support\Facades\Route;

Route::prefix('hod')->name('hod.')->middleware(['auth', 'role:hod'])->group(function () {

    Route::get('/dashboard', [HoDDashboardController::class, 'index'])->name('dashboard');

    Route::get('/students', [HoDStudentController::class, 'index'])->name('students.index');
    Route::get('/students/edit/{student}', [HoDStudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/update/{student}', [HoDStudentController::class, 'update'])->name('students.update');
    Route::get('/students/search', [HoDStudentController::class, 'search'])->name('students.search');

    // Thesis Routes
    Route::get('/thesis', [HoDThesisController::class, 'index'])->name('thesis.index');
    Route::get('/thesis/create', [HoDThesisController::class, 'create'])->name('thesis.create');
    Route::post('/thesis/store', [HoDThesisController::class, 'store'])->name('thesis.store');
    Route::get('/my_thesis/edit/{thesis}', [HoDThesisController::class, 'edit'])->name('my_thesis.edit');
    Route::put('/thesis/update/{thesis}', [HoDThesisController::class, 'update'])->name('thesis.update');
    Route::get('/thesis/view-pdf/{file}', [HoDThesisController::class, 'viewPDF'])->name('thesis.view-pdf');
    Route::delete('/my_thesis/destroy/{thesis}', [HoDThesisController::class, 'destroy'])->name('thesis.destroy');
    Route::get('/my_thesis/my-theses', [HoDThesisController::class, 'myTheses'])->name('my_thesis.my-theses');
    Route::get('/thesis/search', [HoDThesisController::class, 'search'])->name('thesis.search');
    Route::get('/thesis/download/{file}', [HoDThesisController::class, 'downloadPDF'])->name('thesis.download');
    Route::get('/thesis/{thesis}', [HoDThesisController::class, 'show'])
        ->name('thesis.show');

    // Thesis Requests Routes
    Route::get('/thesis-requests/index', [HoDThesisRequestsController::class, 'index'])->name('thesis_requests.index');
    Route::get('/thesis-requests/show/{thesisRequest}', [HoDThesisRequestsController::class, 'show'])->name('thesis_requests.show');
    Route::get('/thesis-requests/view-pdf/{file}', [HoDThesisRequestsController::class, 'viewRequestPDF'])->name('thesis_requests.view-request-pdf');
    Route::post('/thesis-requests/approve/{thesisRequest}', [HoDThesisRequestsController::class, 'approveRequest'])->name('thesis_requests.approve');
    Route::put('/thesis-requests/{thesisRequest}/reject', [HoDThesisRequestsController::class, 'rejectRequest'])->name('thesis_requests.reject');
});
