<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\HoDController as AdminHoDController;
<<<<<<< Updated upstream
use App\Http\Controllers\HoD\HoDController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Student\StudentController;
=======
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\ThesisController as AdminThesisController;
use App\Http\Controllers\Admin\ThesisRequestsController as AdminThesisRequestsController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HoD\HoDController;
use App\Http\Controllers\HoD\ThesisController as HoDThesisController;
use App\Http\Controllers\HoD\ThesisRequestsController as HoDThesisRequestsController;

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\ThesisController as StudentThesisController;
use App\Http\Controllers\Student\ThesisRequestsController as StudentThesisRequestsController;

>>>>>>> Stashed changes
use App\Http\Controllers\ProfileController;
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

<<<<<<< Updated upstream

});

// hod routes
=======
    // Student Routes
    Route::get('/admin/students', [AdminStudentController::class, 'index'])->name('admin.students.index');
    Route::get('/admin/students/edit/{student}', [AdminStudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/admin/students/update/{student}', [AdminStudentController::class, 'update'])->name('admin.students.update');

    // Thesis Routes
    Route::get('/admin/thesis/index', [AdminThesisController::class, 'index'])->name('admin.thesis.index');
    Route::get('/admin/thesis/view-pdf/{file}', [AdminThesisController::class, 'viewPDF'])->name('admin.thesis.view-pdf');
    Route::get('/admin/thesis/my-theses', [AdminThesisController::class, 'myTheses'])->name('admin.thesis.my-theses');

    // Thesis Requests Routes
    Route::get('/admin/thesis-requests/index', [AdminThesisRequestsController::class, 'index'])->name('admin.thesis_requests.index');
    Route::get('/admin/thesis-requests/show/{thesisRequest}', [AdminThesisRequestsController::class, 'show'])->name('admin.thesis_requests.show');
    Route::get('/admin/thesis-requests/view-pdf/{file}', [AdminThesisRequestsController::class, 'viewRequestPDF'])->name('admin.thesis_requests.view-request-pdf');
    Route::post('/admin/thesis-requests/approve/{thesisRequest}', [AdminThesisRequestsController::class, 'approveRequest'])->name('admin.thesis_requests.approve');
    Route::post('/admin/thesis-requests/reject/{thesisRequest}', [AdminThesisRequestsController::class, 'rejectRequest'])->name('admin.thesis_requests.reject');
});
/*
|--------------------------------------------------------------------------
| HoD Routes
|--------------------------------------------------------------------------
*/
>>>>>>> Stashed changes
Route::middleware(['auth', 'role:hod'])->group(function () {
    Route::get('/hod/dashboard', [HoDController::class, 'index'])->name('hod.dashboard');
<<<<<<< Updated upstream
=======

    // Thesis Routes
    Route::get('/hod/thesis', [HoDThesisController::class, 'index'])->name('hod.thesis.index');
    Route::get('/hod/thesis/create', [HoDThesisController::class, 'create'])->name('hod.thesis.create');
    Route::post('/hod/thesis/store', [HoDThesisController::class, 'store'])->name('hod.thesis.store');
    Route::get('/hod/thesis/edit/{thesis}', [HoDThesisController::class, 'edit'])->name('hod.thesis.edit');
    Route::put('/hod/thesis/update/{thesis}', [HoDThesisController::class, 'update'])->name('hod.thesis.update');
    Route::get('/hod/thesis/view-pdf/{file}', [HoDThesisController::class, 'viewPDF'])->name('hod.thesis.view-pdf');
    Route::delete('/hod/thesis/destroy/{thesis}', [HoDThesisController::class, 'destroy'])->name('hod.thesis.destroy');
    Route::get('/hod/thesis/my-theses', [HoDThesisController::class, 'myTheses'])->name('hod.thesis.my-theses');

    // Thesis Requests Routes
    Route::get('/hod/thesis-requests/index', [HoDThesisRequestsController::class, 'index'])->name('hod.thesis_requests.index');
    Route::get('/hod/thesis-requests/show/{thesisRequest}', [HoDThesisRequestsController::class, 'show'])->name('hod.thesis_requests.show');
    Route::get('/hod/thesis-requests/view-pdf/{file}', [HoDThesisRequestsController::class, 'viewRequestPDF'])->name('hod.thesis_requests.view-request-pdf');
    Route::post('/hod/thesis-requests/approve/{thesisRequest}', [HoDThesisRequestsController::class, 'approveRequest'])->name('hod.thesis_requests.approve');
    Route::post('/hod/thesis-requests/reject/{thesisRequest}', [HoDThesisRequestsController::class, 'rejectRequest'])->name('hod.thesis_requests.reject');
>>>>>>> Stashed changes
});

// student routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
<<<<<<< Updated upstream
});


=======

    // thesis routes
    Route::get('/student/thesis', [StudentThesisController::class, 'index'])->name('student.thesis.index');
    Route::get('/student/thesis/view-pdf/{file}', [StudentThesisController::class, 'viewPDF'])->name('student.thesis.view-pdf');
    Route::get('/student/thesis/my-theses', [StudentThesisController::class, 'myTheses'])->name('student.thesis.my-theses');
    Route::get('/student/thesis/create', [StudentThesisController::class, 'create'])->name('student.thesis.create');
    Route::post('/student/thesis/store', [StudentThesisController::class, 'store'])->name('student.thesis.store');
    Route::get('/student/thesis/edit/{thesis}', [StudentThesisController::class, 'edit'])->name('student.thesis.edit');
    Route::put('/student/thesis/update/{thesis}', [StudentThesisController::class, 'update'])->name('student.thesis.update');
    Route::delete('/student/thesis/destroy/{thesis}', [StudentThesisController::class, 'destroy'])->name('student.thesis.destroy');

    // thesis requests routes
    Route::get('/student/thesis-requests/index', [StudentThesisRequestsController::class, 'index'])->name('student.thesis_requests.index');
    Route::get('/student/thesis-requests/show/{thesisRequest}', [StudentThesisRequestsController::class, 'show'])->name('student.thesis_requests.show');
    Route::get('/student/thesis-requests/create', [StudentThesisRequestsController::class, 'create'])->name('student.thesis_requests.create');
    Route::post('/student/thesis-requests/store', [StudentThesisRequestsController::class, 'store'])->name('student.thesis_requests.store');
    Route::get('/student/thesis-requests/view-request-pdf/{file}', [StudentThesisRequestsController::class, 'viewRequestPDF'])->name('student.thesis_requests.view-request-pdf');
});

>>>>>>> Stashed changes
require __DIR__ . '/auth.php';