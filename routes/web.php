<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HoDController as AdminHoDController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HoD\HoDController;
use App\Http\Controllers\HoD\ThesisController as HoDThesisController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\ThesisController as StudentThesisController;
use App\Http\Controllers\Student\ThesisRequestsController as StudentThesisRequestsController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Department Routes
    Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('/admin/departments/store', [DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('/admin/departments/edit/{department}', [DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::put('/admin/departments/update/{department}', [DepartmentController::class, 'update'])->name('admin.departments.update');
    Route::delete('/admin/departments/delete/{department}', [DepartmentController::class, 'destroy'])->name('admin.departments.destroy');

    // HoD Routes
    Route::get('/admin/hods', [AdminHoDController::class, 'index'])->name('admin.hods.index');
    Route::get('/admin/hods/create', [AdminHoDController::class, 'create'])->name('admin.hods.create');
    Route::post('/admin/hods/store', [AdminHoDController::class, 'store'])->name('admin.hods.store');
    Route::get('/admin/hods/edit/{hod}', [AdminHoDController::class, 'edit'])->name('admin.hods.edit');
    Route::put('/admin/hods/update/{hod}', [AdminHoDController::class, 'update'])->name('admin.hods.update');
    Route::delete('/admin/hods/delete/{hod}', [AdminHoDController::class, 'destroy'])->name('admin.hods.destroy');
    Route::get('/admin/hods/search', [AdminHoDController::class, 'search'])->name('admin.hods.search');

    // Student Routes
    Route::get('/admin/students', [AdminStudentController::class, 'index'])->name('admin.students.index');
    Route::get('/admin/students/edit/{student}', [AdminStudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/admin/students/update/{student}', [AdminStudentController::class, 'update'])->name('admin.students.update');
});

/*
|--------------------------------------------------------------------------
| HoD Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:hod'])->group(function () {

    Route::get('/hod/dashboard', [HoDController::class, 'index'])->name('hod.dashboard');

    // Thesis Routes
    Route::get('/hod/thesis', [HoDThesisController::class, 'index'])->name('hod.thesis.index');
    Route::get('/hod/thesis/create', [HoDThesisController::class, 'create'])->name('hod.thesis.create');
    Route::post('/hod/thesis/store', [HoDThesisController::class, 'store'])->name('hod.thesis.store');
    Route::get('/hod/thesis/edit/{thesis}', [HoDThesisController::class, 'edit'])->name('hod.thesis.edit');
    Route::put('/hod/thesis/update/{thesis}', [HoDThesisController::class, 'update'])->name('hod.thesis.update');
    Route::get('/hod/thesis/view-pdf/{file}', [HoDThesisController::class, 'viewPDF'])->name('hod.thesis.view-pdf');
    Route::delete('/hod/thesis/destroy/{thesis}', [HoDThesisController::class, 'destroy'])->name('hod.thesis.destroy');
    Route::get('/hod/thesis/my-theses', [HoDThesisController::class, 'myTheses'])->name('hod.thesis.my-theses');
    Route::get('/hod/thesis/search', [HoDThesisController::class, 'search'])->name('hod.thesis.search');

    // Thesis Requests Routes
    Route::get('/hod/thesis-requests/index', [HoDThesisRequestsController::class, 'index'])->name('hod.thesis_requests.index');
    Route::get('/hod/thesis-requests/show/{thesisRequest}', [HoDThesisRequestsController::class, 'show'])->name('hod.thesis_requests.show');
    Route::get('/hod/thesis-requests/view-pdf/{file}', [HoDThesisRequestsController::class, 'viewRequestPDF'])->name('hod.thesis_requests.view-request-pdf');
    Route::post('/hod/thesis-requests/approve/{thesisRequest}', [HoDThesisRequestsController::class, 'approveRequest'])->name('hod.thesis_requests.approve');
    Route::post('/hod/thesis-requests/reject/{thesisRequest}', [HoDThesisRequestsController::class, 'rejectRequest'])->name('hod.thesis_requests.reject');
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');

    // thesis routes
    Route::get('/student/thesis', [StudentThesisController::class, 'index'])->name('student.thesis.index');
    Route::get('/student/thesis/view-pdf/{file}', [StudentThesisController::class, 'viewPDF'])->name('student.thesis.view-pdf');
    Route::get('/student/thesis/my-theses', [StudentThesisController::class, 'myTheses'])->name('student.thesis.my-theses');
    Route::get('/student/thesis/create', [StudentThesisController::class, 'create'])->name('student.thesis.create');
    Route::post('/student/thesis/store', [StudentThesisController::class, 'store'])->name('student.thesis.store');
    Route::get('/student/thesis/edit/{thesis}', [StudentThesisController::class, 'edit'])->name('student.thesis.edit');
    Route::put('/student/thesis/update/{thesis}', [StudentThesisController::class, 'update'])->name('student.thesis.update');
    Route::delete('/student/thesis/destroy/{thesis}', [StudentThesisController::class, 'destroy'])->name('student.thesis.destroy');
    Route::get('/student/thesis-requests/index', [ThesisRequestsController::class, 'index'])->name('student.thesis_requests.index');
    Route::get('/student/thesis-requests/create', [ThesisRequestsController::class, 'create'])->name('student.thesis_requests.create');
    Route::post('/student/thesis-requests/store', [ThesisRequestsController::class, 'store'])->name('student.thesis_requests.store');
    Route::get('/student/thesis/search', [StudentThesisController::class, 'search'])->name('student.thesis.search');
});

require __DIR__ . '/auth.php';
