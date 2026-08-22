<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Keyword;
use App\Models\Thesis;
use App\Models\ThesisFile;
use App\Models\Student;
use App\Models\SavedThesis;
use App\Models\ViewHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())
        ->firstOrFail();

        $theses = Thesis::with(['files'])->get();
        $departments = Department::all();

        $published_at = Thesis::whereNotNull('published_at')
            ->selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        // $keywords = Keyword::orderBy('keyword_name')->get();

        // Get all thesis IDs saved by this student
        $savedThesisIds = SavedThesis::where('student_id', $student->id)
            ->pluck('thesis_id')
            ->toArray();

        return view('student.thesis.index', compact('theses','savedThesisIds', 'departments', 'published_at'));
    }

    public function viewPDF(ThesisFile $file)
    {
        // this is what I need to add more
        $thesis = $file->thesis;

        if (! $thesis) {
            return redirect()->back()->with('error', 'Thesis not found.');
        }

        // Old
        if (! Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Record that this student viewed the thesis
        ViewHistory::create([
            'user_id' => auth()->id(),
            'thesis_id' => $thesis->id,
            'viewed_at' => now(),
        ]);

        return response()->file(
            storage_path('app/public/'.$file->file_path)
        );

    }

    public function myTheses()
    {
        $theses = Thesis::where('submitted_by', auth()->id())->with('files')->latest()->get();

        return view('student.thesis.my-theses', compact('theses'));
    }

    // add search function to search for theses by title, author_name, or department name
    public function search(Request $request)
    {
        $search = $request->search;
        $query = Thesis::with(['user', 'department', 'keywords']);

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($d) use ($search) {
                        $d->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('keywords', function ($k) use ($search) {
                        $k->where('keyword_name', 'like', "%{$search}%");
                    });
            });
        }

        // department filter
        if ($request->filled('department')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('name', $request->department);
            });
        }

        // year filter
        if ($request->filled('year')) {
            $query->whereYear('published_at', $request->year);
        }

        $theses = $query->get();

        return view('student.thesis.table', compact('theses'));
    }

    public function downloadPDF(ThesisFile $file)
    {
        $filePath = storage_path('app/public/'.$file->file_path);

        if (! file_exists($filePath)) {
            return back()->with('error', 'PDF file not found.');
        }

        $fileName = preg_replace(
            '/[\/\\\\:*?"<>|]/',
            '-',
            $file->thesis->title
        ).'.pdf';

        return response()->download(
            $filePath,
            $fileName
        );
    }

    // View history
    public function history()
    {
        $histories = ViewHistory::with(['thesis.files'])
            ->where('user_id', auth()->id())
            ->latest('viewed_at')
            ->get();

        return view('student.thesis.view_history', compact('histories'));
    }
}
