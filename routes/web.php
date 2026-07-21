<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HoDController as AdminHoDController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\HoD\HoDController;
use App\Http\Controllers\HoD\ThesisController as HoDThesisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// /// for /role/dashboard
// admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('/admin/departments/store', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('/admin/departments/edit/{department}', [DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::put('/admin/departments/update/{department}', [DepartmentController::class, 'update'])->name('admin.departments.update');
    Route::delete('/admin/departments/delete/{department}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');

    // HoD routes
    Route::get('/admin/hods', [AdminHoDController::class, 'index'])->name('admin.hods.index');
    Route::get('/admin/hods/create', [AdminHoDController::class, 'create'])->name('admin.hods.create');
    Route::post('/admin/hods/store', [AdminHoDController::class, 'store'])->name('admin.hods.store');
    Route::get('/admin/hods/edit/{hod}', [AdminHoDController::class, 'edit'])->name('admin.hods.edit');
    Route::put('/admin/hods/update/{hod}', [AdminHoDController::class, 'update'])->name('admin.hods.update');
    Route::delete('/admin/hods/delete/{hod}', [AdminHoDController::class, 'destroy'])->name('admin.hods.destroy');

    //Student routes
    Route::get('/admin/students', [AdminStudentController::class, 'index'])->name('admin.students.index');
    Route::get('/admin/students/edit/{student}', [AdminStudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/admin/students/update/{student}', [AdminStudentController::class, 'update'])->name('admin.students.update');

});

// hod routes
Route::middleware(['auth', 'role:hod'])->group(function () {
    Route::get('/hod/dashboard', [HoDController::class, 'index'])->name('hod.dashboard');

    //Thesis routes
    Route::get('/hod/thesis', [HoDThesisController::class, 'index'])->name('hod.thesis.index');
    Route::get('/hod/thesis/create', [HoDThesisController::class, 'create'])->name('hod.thesis.create');
    Route::get('/hod/thesis/edit/{thesis}', [HoDThesisController::class, 'edit'])->name('hod.thesis.edit');
    Route::post('/hod/thesis/store', [HoDThesisController::class, 'store'])->name('hod.thesis.store');
    Route::put('/hod/thesis/update/{thesis}', [HoDThesisController::class, 'update'])->name('hod.thesis.update');

});

// student routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
});

require __DIR__.'/auth.php';
