<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('department', 'user')->get();

        return view('admin.students.index', compact('students'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Student $student)
    {
        $student->update([
            'upload_permission' => request()->has('upload_permission'),
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

}
