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
        $students = Student::with('department', 'user')->get();
        $departments = Department::all();
        $started_year = Student::whereNotNull('started_year')
            ->select('started_year')
            ->distinct()
            ->orderBy('started_year', 'desc')
            ->pluck('started_year');
        $totalStudent = Student::count();
        return view('hod.student.index', compact('students', 'departments','started_year', 'totalStudent'));
    }

    public function edit(Student $student)
    {
        return view('hod.student.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update([
            'upload_permission' => $request->upload_permission,
        ]);

        return redirect()->route('hod.student.index')->with('success', 'Student updated successfully.');
    }

    // Add a method to handle the search functionality for HoDs
    public function search(Request $request)
    {
        $search = $request->search;

        $query = Student::with(['user', 'department']);

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($user) use ($search) {
                        $user->where('username', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('department', function ($department) use ($search) {
                        $department->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Department filter
        if ($request->filled('department')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('name', $request->department);
            });
        }

        // Year filter
        if ($request->filled('year')) {
            $query->where('started_year', $request->year);
        }

        $students = $query->get();

        return view('hod.student.table', compact('students'));
    }

}
