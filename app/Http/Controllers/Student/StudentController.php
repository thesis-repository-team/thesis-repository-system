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

        // Add your actual thesis query here
        $thesesCount = 0;

        // Add your actual saved thesis query here
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

    // public function index()
    // {
    //     $user = auth()->user();

    //     return view('student.dashboard', compact('user'));
    // }
}
