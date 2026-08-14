<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Thesis;
use App\Models\ThesisFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
    //
    public function index()
    {
        $theses = Thesis::latest()->get();
        $departments = Department::all();

        return view('admin.thesis.index', compact('theses', 'departments'));
    }

    public function viewPDF(ThesisFile $file)
    {
        if (!Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(
            storage_path('app/public/' . $file->file_path)
        );
    }

    public function create()
    {
        $departments = Department::all();

        return view('admin.thesis.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',

            // thesis file
            'files' => 'required|array|min:1',
            'files.*' => 'required|file|mimes:pdf|max:20480',
        ]);

        DB::transaction(function () use ($request) {
            $thesis = Thesis::create([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'description' => $request->description,
                'department_id' => $request->department_id,
                'author_name' => $request->author_name,
                'submitted_by' => auth()->id(),
                'published_by' => auth()->id(),
                'published_at' => now(),
            ]);

            foreach ($request->file('files') as $file) {
                $path = $file->store('thesis_files', 'public');
                ThesisFile::create([
                    'thesis_id' => $thesis->id,
                    'file_name' => $thesis->title . '.pdf',
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $path,
                    'uploaded_at' => now(),
                ]);
            }
        });

        return redirect()->route('admin.thesis.index')->with('success', 'Thesis created successfully.');
    }

    public function edit(Thesis $thesis)
    {
        $departments = Department::all();

        if (auth()->user()->hod->department_id !== $thesis->department_id) {
            return redirect()->route('admin.thesis.index')->with('error', 'You are not allowed to edit theses from another department.');
        }

        return view('admin.thesis.edit', compact('thesis', 'departments'));
    }

    public function update(Request $request, Thesis $thesis)
    {
        if (auth()->user()->hod->department_id !== $thesis->department_id) {
            return redirect()
                ->route('admin.thesis.index')->with('error', 'You are not allowed to edit theses from another department.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',

            'files' => 'nullable|array',
            'files.*' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        DB::transaction(function () use ($request, $thesis) {

            $thesis->update([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'description' => $request->description,
                'author_name' => $request->author_name,
            ]);

            // replace old files if new ones are uploaded
            if ($request->hasFile('files')) {
                // delete old files from storage and database
                foreach ($thesis->files as $oldFile) {
                    Storage::disk('public')->delete($oldFile->file_path);
                    $oldFile->delete();
                }

                // save new files
                foreach ($request->file('files') as $file) {
                    $path = $file->store('thesis_files', 'public');
                    ThesisFile::create([
                        'thesis_id' => $thesis->id,
                        'file_name' => $thesis->title . '.pdf',
                        'file_type' => $file->getClientOriginalExtension(),
                        'file_path' => $path,
                        'uploaded_at' => now(),
                    ]);
                }
            }
        });
        return redirect()->route('admin.thesis.index')->with('success', 'Thesis updated successfully.');
    }

    // Add a search function to search for theses by title, author_name, or department name
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

        // Department filter
        if ($request->filled('department')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('name', $request->department);
            });
        }

        // Year filter
        if ($request->filled('year')) {
            $query->whereYear('published_at', $request->year);
        }

        $theses = $query->get();

        return view('admin.thesis.table', compact('theses'));
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
