<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Notifications\ThesisRequestStatusUpdated;
use App\Models\Thesis;
use App\Models\ThesisFile;
use App\Models\ThesisRequest;
use Illuminate\Http\Request;

class ThesisRequestsController extends Controller
{
    //
    public function index()
    {
        $thesisRequests = ThesisRequest::with([
            'user',
            'department',
            'thesis.publishedBy'
        ])->latest()->get();

        return view('hod.thesis_requests.index', compact('thesisRequests'));
    }

    public function show(ThesisRequest $thesisRequest)
    {
        $thesis = Thesis::with(['publishedBy.hod', 'submittedBy.student'])->findOrFail($thesisRequest->thesis_id);
        return view('hod.thesis_requests.show', compact('thesisRequest', 'thesis'));
    }

    public function viewRequestPDF(ThesisRequest $file)
    {
        if (! \Illuminate\Support\Facades\Storage::disk('public')->exists($file->pdf_file)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(storage_path('app/public/' . $file->pdf_file));
    }

    // approve a request
    public function approveRequest(ThesisRequest $thesisRequest)
    {
        $request = ThesisRequest::findOrFail($thesisRequest->id);
        // create the Thesis record
        $thesis = Thesis::create([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'description' => $request->description ?? '',
            'department_id' => $request->department_id,
            'author_name' => $request->author_name,
            'submitted_by' => $request->submitted_by,
            'published_by' => auth()->user()->id,
            'published_at' => now(),
        ]);

        ThesisFile::create([
            'thesis_id' => $thesis->id, // get the id of the thesis record we just created
            'file_name' => $request->pdf_file,
            'file_type' => 'pdf',
            'file_path' => $request->pdf_file,
            'uploaded_at' => now(),
        ]);

        $request->status = 'approved';
        $request->thesis_id = $thesis->id;
        $request->save();

        // Notify the student
        $student = User::find($request->submitted_by);

        session()->flash('request_approved', "Your thesis request '{$request->title}' has been approved!");

        return redirect()->route('hod.dashboard')->with('success', 'Request approved and thesis created.');
    }

    // reject a request
    public function rejectRequest(ThesisRequest $thesisRequest)
    {
        $request = ThesisRequest::findOrFail($thesisRequest->id);
        $request->status = 'rejected';
        $request->save();

        // Notify the student
        $student = User::find($request->submitted_by);

        return redirect()->route('hod.dashboard')->with('error', 'Request rejected.');
    }
}
