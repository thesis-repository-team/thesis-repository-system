<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $student = $user->student;
        $department = $student?->department;
        $departmentsCount = Department::count();
        $thesesCount = 0;
        $savedThesesCount = 0;
        $recentTheses = collect();

        return view('student.dashboard', compact(
            'user',
            'student',
            'department',
            'departmentsCount',
            'thesesCount',
            'savedThesesCount',
            'recentTheses'
        ));
    }
}
