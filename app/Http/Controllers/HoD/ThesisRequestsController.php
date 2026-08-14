<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Notifications\ThesisRequestStatusUpdated;
use App\Models\User;
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
        $thesis = null;

        if ($thesisRequest->thesis_id) {
            $thesis = Thesis::with([
                'publishedBy.hod',
                'submittedBy.student'
            ])->find($thesisRequest->thesis_id);
        }

        return view('hod.thesis_requests.show', compact('thesisRequest', 'thesis'));
    }

    public function viewRequestPDF(ThesisRequest $file)
    {
        if (! \Illuminate\Support\Facades\Storage::disk('public')->exists($file->pdf_file)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(storage_path('app/public/' . $file->pdf_file));
    }

    // // approve a request
    // public function approveRequest(ThesisRequest $thesisRequest)
    // {
    //     $request = ThesisRequest::findOrFail($thesisRequest->id);
    //     // create the Thesis record
    //     $thesis = Thesis::create([
    //         'title' => $request->title,
    //         'abstract' => $request->abstract,
    //         'description' => $request->description ?? '',
    //         'department_id' => $request->department_id,
    //         'author_name' => $request->author_name,
    //         'submitted_by' => $request->submitted_by,
    //         'published_by' => auth()->user()->id,
    //         'published_at' => now(),
    //     ]);

    //     ThesisFile::create([
    //         'thesis_id' => $thesis->id,
    //         'file_name' => $thesis->title . '.pdf',
    //         'file_type' => 'pdf',
    //         'file_path' => $request->pdf_file,
    //         'uploaded_at' => now(),
    //     ]);

    //     $request->status = 'approved';
    //     $request->thesis_id = $thesis->id;
    //     $request->reviewed_by = auth()->id();
    //     $request->reviewed_at = now();
    //     $request->save();

    //     // Notify the student
    //     $student = User::find($request->submitted_by);
    //     if ($student) {
    //         $student->notify(
    //             new ThesisRequestStatusUpdated($request)
    //         );
    //     }

    //     session()->flash('request_approved', "Your thesis request '{$request->title}' has been approved!");

    //     return redirect()->route('hod.dashboard')->with('success', 'Request approved and thesis created.');
    // }


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
            'thesis_id' => $thesis->id,
            'file_name' => $thesis->title . '.pdf',
            'file_type' => 'pdf',
            'file_path' => $request->pdf_file,
            'uploaded_at' => now(),
        ]);

        $request->status = 'approved';
        $request->thesis_id = $thesis->id;
        $request->reviewed_by = auth()->id();
        $request->reviewed_at = now();
        $request->save();

        // Notify the student
        $student = User::find($request->submitted_by);

        if ($student) {
            $student->notify(
                new ThesisRequestStatusUpdated($request)
            );
        }

        session()->flash('request_approved', "Your thesis request '{$request->title}' has been approved!");

        return redirect()->route('hod.dashboard')->with('success', 'Request approved and thesis created.');
    }
    
    public function rejectRequest(Request $request, ThesisRequest $thesisRequest)
    {
        $request->validate([
            'remarks' => 'required|string|max:5000',
        ]);

        $thesisRequest->status = 'rejected';
        $thesisRequest->remarks = $request->remarks;
        $thesisRequest->reviewed_by = auth()->id();
        $thesisRequest->reviewed_at = now();
        $thesisRequest->save();

        $student = User::find($thesisRequest->submitted_by);

        if ($student) {
            $student->notify(new ThesisRequestStatusUpdated($thesisRequest));
        }

        return redirect()->route('hod.dashboard')
            ->with('error', 'Request rejected.');
    }
}