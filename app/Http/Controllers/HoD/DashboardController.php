<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $hod = $user->hod;

        if (!$hod) {
            abort(403);
        }

        $departmentId = $hod->department_id;

        $department = Department::find($departmentId);

        $studentsCount = Student::where('department_id', $departmentId)->count();

        $thesesCount = Thesis::where('department_id', $departmentId)->count();

        $pendingRequestsCount = ThesisRequest::where('department_id', $departmentId)
            ->whereNull('is_approved')
            ->count();

        $recentStudents = Student::where('department_id', $departmentId)
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentThesisRequests = ThesisRequest::where('department_id', $departmentId)
            ->with([
                'user',
                'thesis'
            ])
            ->latest()
            ->take(5)
            ->get();

        $recentTheses = Thesis::where('department_id', $departmentId)
            ->latest()
            ->take(5)
            ->get();

        return view('hod.dashboard', compact(
            'department',
            'studentsCount',
            'thesesCount',
            'pendingRequestsCount',
            'recentStudents',
            'recentThesisRequests',
            'recentTheses'
        ));
    }
}