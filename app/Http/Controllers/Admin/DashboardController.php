<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Hod;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $departmentsCount = Department::count();

        $hodsCount = Hod::count();

        $studentsCount = Student::count();

        $thesesCount = Thesis::count();

        $recentTheses = Thesis::latest()
            ->take(5)
            ->get();

        $recentThesisRequests = ThesisRequest::with([
            'user',
            'thesis'
        ])
            ->latest()
            ->take(5)
            ->get();

        $recentStudents = Student::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentHods = Hod::with([
            'user',
            'department'
        ])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'departmentsCount',
            'hodsCount',
            'studentsCount',
            'thesesCount',
            'recentTheses',
            'recentThesisRequests',
            'recentStudents',
            'recentHods'
        ));
    }
}