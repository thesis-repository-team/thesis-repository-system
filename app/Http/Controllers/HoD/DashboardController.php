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
            abort(403, 'HoD profile not found.');
        }

        // HoD department
        $departmentId = $hod->department_id;

        if (!$departmentId) {
            abort(403, 'HoD department is not assigned.');
        }

        $department = Department::find($departmentId);

        if (!$department) {
            abort(403, 'Department not found.');
        }

        $studentsCount = Student::where(
            'department_id',
            $departmentId
        )->count();


        $thesesCount = Thesis::where(
            'department_id',
            $departmentId
        )->count();


        $pendingRequestsCount = ThesisRequest::where(
            'department_id',
            $departmentId
        )
            ->whereNull('is_approved')
            ->count();


        $approvedThesisCount = ThesisRequest::where(
            'department_id',
            $departmentId
        )
            ->where('is_approved', 1)
            ->count();


        $rejectedRequestsCount = ThesisRequest::where(
            'department_id',
            $departmentId
        )
            ->where('is_approved', 0)
            ->count();


        $publishedThesisCount = Thesis::where(
            'department_id',
            $departmentId
        )
            ->where('is_approved', 1)
            ->count();

        $recentStudents = Student::where(
            'department_id',
            $departmentId
        )
            ->with('user')
            ->latest()
            ->take(5)
            ->get();


        $recentRequests = ThesisRequest::where(
            'department_id',
            $departmentId
        )
            ->with([
                'user',
                'thesis'
            ])
            ->latest()
            ->take(5)
            ->get();


        $recentTheses = Thesis::where(
            'department_id',
            $departmentId
        )
            ->latest()
            ->take(5)
            ->get();

        return view('hod.dashboard', compact(
            'department',
            'studentsCount',
            'thesesCount',
            'pendingRequestsCount',
            'approvedThesisCount',
            'rejectedRequestsCount',
            'publishedThesisCount',
            'recentStudents',
            'recentRequests',
            'recentTheses'
        ));
    }
}