<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\Hod;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (! $user) {
            abort(403);
        }

        if ($user->role !== 'hod') {
            abort(403);
        }

        $hod = Hod::with('department')
            ->where('user_id', $user->id)
            ->firstOrFail();

        $department = $hod->department;

        if (! $department) {
            abort(404, 'HoD department not found.');
        }

        $departmentId = $department->id;

        $pendingRequestsCount = ThesisRequest::where(
            'department_id',
            $departmentId
        )
            ->where('status', 'pending')
            ->count();

        $approvedThesisCount = ThesisRequest::where(
            'department_id',
            $departmentId
        )
            ->where('status', 'approved')
            ->count();

        $rejectedRequestsCount = ThesisRequest::where(
            'department_id',
            $departmentId
        )
            ->where('status', 'rejected')
            ->count();

        $thesesCount = Thesis::where(
            'department_id',
            $departmentId
        )
            ->whereNotNull('published_at')
            ->count();

        $publishedThesisCount = $thesesCount;

        $studentsCount = Student::where(
            'department_id',
            $departmentId
        )
            ->count();

        $recentRequests = ThesisRequest::with([
            'user',
            'thesis',
        ])
            ->where('department_id', $departmentId)
            ->latest('submitted_at')
            ->take(5)
            ->get();

        $recentTheses = Thesis::with([
            'submittedBy',
        ])
            ->where('department_id', $departmentId)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(5)
            ->get();

        $recentStudents = Student::with([
            'user',
        ])
            ->where('department_id', $departmentId)
            ->latest()
            ->take(5)
            ->get();

        return view('hod.dashboard', compact(
            'department',
            'pendingRequestsCount',
            'approvedThesisCount',
            'rejectedRequestsCount',
            'thesesCount',
            'studentsCount',
            'publishedThesisCount',
            'recentRequests',
            'recentTheses',
            'recentStudents'
        ));
    }
}
