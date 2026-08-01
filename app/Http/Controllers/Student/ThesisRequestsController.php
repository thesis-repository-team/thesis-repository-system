<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ThesisRequest;
use App\Models\Thesis;
use App\Models\Department;
use Illuminate\Http\Request;

class ThesisRequestsController extends Controller
{
    public function index()
    {
        $thesisRequests = ThesisRequest::where('submitted_by', auth()->id())->latest()->get();
    
        return view('student.thesis_requests.index', compact('thesisRequests'));
    }

    public function create()
    {
        $departments = Department::all();
        $theses = Thesis::all();
        return view('student.thesis_requests.create', compact('departments', 'theses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'department_id' => 'required|exists:departments,id',
            'thesis_id' => 'nullable|exists:theses,id',
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'pdf_file' => 'required|file|mimes:pdf|max:20480', // 20MB max
        ]);

        $pdfFilePath = $request->file('pdf_file')->store('thesis_requests_files', 'public');

        ThesisRequest::create([
            'submitted_by' => auth()->id(),
            'department_id' => auth()->user()->student->department_id,
            'thesis_id' => null,
            'title' => $request->title,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'pdf_file' => $pdfFilePath,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return redirect()->route('student.thesis_requests.index')->with('success', 'Thesis request submitted successfully.');
    }

}
