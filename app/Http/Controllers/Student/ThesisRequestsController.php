<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Hod;
use App\Models\Thesis;
use App\Models\ThesisRequest;
use App\Models\User;
use App\Notifications\ThesisRequestSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisRequestsController extends Controller
{
    public function index()
    {
        $thesisRequests = ThesisRequest::where('submitted_by', auth()->id())->latest()->get();

        return view('student.thesis_requests.index', compact('thesisRequests'));
    }

    public function show(ThesisRequest $thesisRequest)
    {
        // Make sure the logged-in student owns this request
        if ($thesisRequest->submitted_by !== auth()->id()) {
            abort(403);
        }

        $thesis = null;

        if ($thesisRequest->thesis_id) {
            $thesis = Thesis::with([
                'publishedBy.hod',
                'submittedBy.student',
            ])->find($thesisRequest->thesis_id);
        }

        return view('student.thesis_requests.show', compact('thesisRequest', 'thesis'));
    }

    public function create()
    {
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

    // For Student rejected thesis
    public function rejected(ThesisRequest $thesisRequest)
    {
        $thesisRequest->load([
            'thesis',
            'department',
            'user',
        ]);

        // Make sure this request belongs to the logged-in student
        if ($thesisRequest->submitted_by !== auth()->id()) {
            abort(403);
        }

        // Only rejected requests can access this page
        if ($thesisRequest->status !== 'rejected') {
            return redirect()
                ->route('student.thesis_requests.index')
                ->with('error', 'This thesis is not rejected.');
        }

        return view(
            'student.thesis_requests.rejected',
            compact('thesisRequest')
        );
    }

    // When thesis is rejected, student can resubmit
    public function resubmit(Request $request, ThesisRequest $thesisRequest)
    {

        // Make sure this request belongs to the logged-in student
        if ($thesisRequest->submitted_by != auth()->id()) {
            abort(403);
        }

        // Only rejected requests can be resubmitted
        if ($thesisRequest->status !== 'rejected') {
            return back()->with(
                'error',
                'Only rejected thesis requests can be resubmitted.'
            );
        }

        // Validate
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'thesis_file' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
        ]);

        // Update title
        $thesisRequest->title = $request->title;
        $thesisRequest->author_name = $request->author_name;
        $thesisRequest->abstract = $request->abstract;
        $thesisRequest->description = $request->description;

        if ($request->hasFile('thesis_file')) {

            // Delete old PDF
            if (
                $thesisRequest->pdf_file &&
                Storage::disk('public')->exists($thesisRequest->pdf_file)
            ) {
                Storage::disk('public')->delete(
                    $thesisRequest->pdf_file
                );
            }

            // Store new PDF
            $pdfFilePath = $request->file('thesis_file')
                ->store('thesis_requests_files', 'public');

            $thesisRequest->pdf_file = $pdfFilePath;
        }

        // Change request back to pending
        $thesisRequest->update([
            'status' => 'pending',
            // Keep the rejection comment for history
            // Clear previous approval information
            'approved_by' => null,
            'approved_at' => null,
        ]);
        $thesisRequest->save();

        // Notify To Hod
        $hod = Hod::where(
            'department_id',
            $thesisRequest->department_id
        )
            ->where('is_active', true)
            ->first();

        if ($hod && $hod->user) {
            $hod->user->notify(
                new ThesisRequestSubmitted($thesisRequest)
            );
        }

        // Notify To Admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(
                new ThesisRequestSubmitted($thesisRequest)
            );
        }

        return redirect()
            ->route('student.thesis_requests.index')
            ->with(
                'success',
                'Your thesis has been resubmitted successfully.'
            );
    }
}
