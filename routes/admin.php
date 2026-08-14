<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HoDController as AdminHoDController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\ThesisController as AdminThesisController;
use App\Http\Controllers\Admin\ThesisRequestsController as AdminThesisRequestsController;

// admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('/departments/edit/{department}', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::put('/departments/update/{department}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/delete/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

    // HoD routes
    Route::get('/hods', [AdminHoDController::class, 'index'])->name('hods.index');
    Route::get('/hods/create', [AdminHoDController::class, 'create'])->name('hods.create');
    Route::post('/hods/store', [AdminHoDController::class, 'store'])->name('hods.store');
    Route::get('/hods/edit/{hod}', [AdminHoDController::class, 'edit'])->name('hods.edit');
    Route::put('/hods/update/{hod}', [AdminHoDController::class, 'update'])->name('hods.update');
    Route::delete('/hods/delete/{hod}', [AdminHoDController::class, 'destroy'])->name('hods.destroy');
    Route::get('/hods/search', [AdminHoDController::class, 'search'])->name('hods.search');

    // Student Routes
    Route::get('/students', [AdminStudentController::class, 'index'])->name('students.index');
    Route::get('/students/edit/{student}', [AdminStudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/update/{student}', [AdminStudentController::class, 'update'])->name('students.update');
    Route::get('/students/search', [AdminStudentController::class, 'search'])->name('students.search');

    // Thesis Routes
    Route::get('/thesis/index', [AdminThesisController::class, 'index'])->name('thesis.index');
    Route::get('/thesis/view-pdf/{file}', [AdminThesisController::class, 'viewPDF'])->name('thesis.view-pdf');
    Route::get('/thesis/create', [AdminThesisController::class, 'create'])->name('thesis.create');
    Route::post('/thesis/store', [AdminThesisController::class, 'store'])->name('thesis.store');
    Route::get('/thesis/edit/{thesis}', [AdminThesisController::class, 'edit'])->name('thesis.edit');
    Route::put('/thesis/update/{thesis}', [AdminThesisController::class, 'update'])->name('thesis.update');
    Route::delete('/thesis/destroy/{thesis}', [AdminThesisController::class, 'destroy'])->name('thesis.destroy');
    Route::get('/thesis/my-theses', [AdminThesisController::class, 'myTheses'])->name('thesis.my-theses');
    Route::get('/thesis/search', [AdminThesisController::class, 'search'])->name('thesis.search');
    Route::get('/thesis/download/{file}', [AdminThesisController::class, 'downloadPDF'])->name('thesis.download');


    // Thesis Requests Routes
    Route::get('/thesis-requests/index', [AdminThesisRequestsController::class, 'index'])->name('thesis_requests.index');
    Route::get('/thesis-requests/show/{thesisRequest}', [AdminThesisRequestsController::class, 'show'])->name('thesis_requests.show');
    Route::get('/thesis-requests/view-pdf/{file}', [AdminThesisRequestsController::class, 'viewRequestPDF'])->name('thesis_requests.view-request-pdf');
    Route::post('/thesis-requests/approve/{thesisRequest}', [AdminThesisRequestsController::class, 'approveRequest'])->name('thesis_requests.approve');
    Route::put('/thesis-requests/{thesisRequest}/reject', [AdminThesisRequestsController::class, 'rejectRequest'])->name('thesis_requests.reject');
});
