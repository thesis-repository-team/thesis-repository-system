<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $departmentId = auth()->user()->hod->department_id;
        $department = auth()->user()->hod->department;

        $students = Student::with('department', 'user')
            ->where('department_id', $departmentId)
            ->get();

        $departments = Department::where('id', $departmentId)->get();

        $started_year = Student::where('department_id', $departmentId)
            ->whereNotNull('started_year')
            ->select('started_year')
            ->distinct()
            ->orderBy('started_year', 'desc')
            ->pluck('started_year');

        $totalStudent = Student::where('department_id', $departmentId)->count();

        return view('hod.students.index', compact(
            'department',
            'students',
            'departments',
            'started_year',
            'totalStudent'
        ));
    }
    public function edit(Student $student)
    {
        return view('hod.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update([
            'upload_permission' => $request->upload_permission,
        ]);

        return redirect()->route('hod.students.index')->with('success', 'Student updated successfully.');
    }

    // Add a method to handle the search functionality for HoDs
    public function search(Request $request)
    {
        $departmentId = auth()->user()->hod->department_id;
        $search = $request->search;

        $query = Student::with(['user', 'department'])
            ->where('department_id', $departmentId);

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('username', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Year filter
        if ($request->filled('year')) {
            $query->where('started_year', $request->year);
        }

        $students = $query->get();

        return view('hod.students.table', compact('students'));
    }
}
