<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Thesis;
use App\Models\User;
use App\Models\Hod;
use App\Notifications\ThesisRequestSubmitted;
use App\Models\ThesisRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisRequestsController extends Controller
{
    public function index()
    {
        if (! auth()->user()->student->upload_permission) {
            return redirect()->route('student.thesis.index')->with('error', 'You do not have permission to upload a thesis request. Please contact your Head of Department.');
        }
        $thesisRequests = ThesisRequest::where('submitted_by', auth()->id())->latest()->get();

        return view('student.thesis_requests.index', compact('thesisRequests'));
    }

    public function show(ThesisRequest $thesisRequest)
    {
        if (! auth()->user()->student->upload_permission) {
            return redirect()->route('student.thesis.index')->with('error', 'You do not have permission to upload a thesis request. Please contact your Head of Department.');
        }

        return view('student.thesis_requests.show', compact('thesisRequest'));
    }

    public function create()
    {
        // if(ThesisRequest::where('submitted_by', auth()->id())->where('status', 'pending')->exists()) {
        //     return redirect()->route('student.thesis_requests.index')->with('error', 'You already have a pending thesis request. Please wait for it to be reviewed before submitting a new one.');
        // }
        if (! auth()->user()->student->upload_permission) {
            return redirect()->route('student.thesis.index')->with('error', 'You do not have permission to upload a thesis request. Please contact your Head of Department.');
        }

        $departments = Department::all();
        $theses = Thesis::all();

        return view('student.thesis_requests.create', compact('departments', 'theses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            // 'department_id' => 'required|exists:departments,id',
            'thesis_id' => 'nullable|exists:theses,id',
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'pdf_file' => 'required|file|mimes:pdf|max:20480', // 20MB max
        ]);

        $pdfFilePath = $request->file('pdf_file')->store('thesis_requests_files', 'public');

        $thesisRequest = ThesisRequest::create([
            'author_name' => $request->author_name,
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

        // Find HoD
        $hod = Hod::where('department_id', $thesisRequest->department_id)
            ->where('is_active', true)
            ->first();

        // Send notification to HoD
        if ($hod && $hod->user) {
            $hod->user->notify(
                new ThesisRequestSubmitted($thesisRequest)
            );
        }

        // Find Admins
        $admins = User::where('role', 'admin')->get();

        // Send notification to Admins
        foreach ($admins as $admin) {
            $admin->notify(
                new ThesisRequestSubmitted($thesisRequest)
            );
        }

        return redirect()->route('student.thesis_requests.index')->with('success', 'Thesis request submitted successfully.');
    }

    public function viewRequestPDF(ThesisRequest $file)
    {
        if (! auth()->user()->student->upload_permission) {
            return redirect()->route('student.thesis.index')->with('error', 'You do not have permission to upload a thesis request. Please contact your Head of Department.');
        }

        if (! Storage::disk('public')->exists($file->pdf_file)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(storage_path('app/public/'.$file->pdf_file));
    }
}
