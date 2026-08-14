<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Thesis;
use App\Models\ThesisFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    public function index()
    {
        $theses = Thesis::with('files')->get();
        $departments = Department::all();

        return view('student.thesis.index', compact('theses', 'departments'));
    }

    public function viewPDF(ThesisFile $file)
    {
        if (! Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(
            storage_path('app/public/' . $file->file_path)
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
        $query = Thesis::with(['user', 'department']);

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($d) use ($search) {
                        $d->where('name', 'like', "%{$search}%");
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
        $filePath = storage_path('app/public/' . $file->file_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'PDF file not found.');
        }

        $fileName = preg_replace(
            '/[\/\\\\:*?"<>|]/',
            '-',
            $file->thesis->title
        ) . '.pdf';

        return response()->download(
            $filePath,
            $fileName
        );
    }
}