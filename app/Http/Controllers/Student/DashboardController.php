<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\SavedThesis;
use App\Models\Thesis;
use App\Models\ThesisRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $student = $user->student;

        $department = null;

        if ($student && $student->department_id) {
            $department = Department::find($student->department_id);
        }

        $thesesCount = Thesis::whereNotNull('published_at')
            ->count();

        $totalRequests = 0;

        if ($user->role === 'student') {
            $totalRequests = ThesisRequest::where(
                'submitted_by',
                $user->id
            )->count();
        }

        $savedThesesCount = SavedThesis::where(
            'user_id',
            $user->id
        )->count();

        $downloadsCount = 0;

        $recentTheses = Thesis::with([
            'department',
        ])
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(5)
            ->get();

        $recentRequests = collect();

        if ($user->role === 'student') {
            $recentRequests = ThesisRequest::where(
                'submitted_by',
                $user->id
            )
                ->latest('submitted_at')
                ->take(5)
                ->get();
        }

        return view('student.dashboard', compact(
            'student',
            'department',
            'thesesCount',
            'savedThesesCount',
            'totalRequests',
            'downloadsCount',
            'recentTheses',
            'recentRequests'
        ));
    }
}
