<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HoDController as AdminHoDController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Student\StudentController;

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


///// for /role/dashboard 
// admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('/admin/departments/store', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('/admin/departments/edit/{department}', [DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::put('/admin/departments/update/{department}', [DepartmentController::class, 'update'])->name('admin.departments.update');
    Route::delete('/admin/departments/delete/{department}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');

    //HoD routes
    Route::get('/admin/hods', [AdminHoDController::class, 'index'])->name('admin.hods.index');
    Route::get('/admin/hods/create', [AdminHoDController::class, 'create'])->name('admin.hods.create');
    Route::post('/admin/hods/store', [AdminHoDController::class, 'store'])->name('admin.hods.store');
    Route::get('/admin/hods/edit/{hod}', [AdminHoDController::class, 'edit'])->name('admin.hods.edit');
    Route::put('/admin/hods/update/{hod}', [AdminHoDController::class, 'update'])->name('admin.hods.update');
    Route::delete('/admin/hods/delete/{hod}', [AdminHoDController::class, 'destroy'])->name('admin.hods.destroy');


});

// hod routes
Route::middleware(['auth', 'role:hod'])->group(function () {
    Route::get('/hod/dashboard', [HodController::class, 'index'])->name('hod.dashboard');
});

// student routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
});


require __DIR__ . '/auth.php';