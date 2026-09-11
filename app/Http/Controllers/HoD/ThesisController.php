<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\HoD;
use App\Models\Keyword;
use App\Models\Thesis;
use App\Models\ThesisFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
{
  public function index()
{
    $theses = Thesis::with('files')
        ->whereNotNull('published_at')
        ->orderByDesc('published_at')
        ->get();

    $departments = Department::all();

    $academicYears = Thesis::whereNotNull('academic_year')
        ->select('academic_year')
        ->distinct()
        ->orderByDesc('academic_year')
        ->pluck('academic_year');

    return view('hod.thesis.index', compact(
        'theses',
        'departments',
        'academicYears'
    ));
}
    // public function index()
    // {
    //     $theses = Thesis::with('files')
    //         ->whereNotNull('published_at')
    //         ->orderByDesc('published_at')
    //         ->get();
    //     $departments = Department::all();

    //     $published_at = Thesis::whereNotNull('published_at')
    //         ->selectRaw('YEAR(published_at) as year')
    //         ->distinct()
    //         ->orderBy('year', 'desc')
    //         ->pluck('year');
    //     // $keywords = Keyword::orderBy('keyword_name')->get();

    //     return view('hod.thesis.index', compact('theses', 'departments', 'published_at'));
    // }

    public function create()
    {
        $hod = HoD::with('department')
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $department = $hod->department;

        return view('hod.thesis.create', compact('department'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',
            'academic_year' => 'required|integer|digits:4',

            // thesis file
            'files' => 'required|array|min:1',
            'files.*' => 'required|file|mimes:pdf|max:20480',
        ]);

        DB::transaction(function () use ($request) {
            $department_id = auth()->user()->hod->department_id;
            $thesis = Thesis::create([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'description' => $request->description,
                'department_id' => $department_id,
                'author_name' => $request->author_name,
                'academic_year' => $request->academic_year,
                'submitted_by' => auth()->id(),
                'published_by' => auth()->id(),
                'published_at' => now(),
            ]);

            foreach ($request->file('files') as $file) {
                $path = $file->store('thesis_files', 'public');
                ThesisFile::create([
                    'thesis_id' => $thesis->id,
                    'file_name' => $thesis->title.'.pdf',
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $path,
                    'uploaded_at' => now(),
                ]);
            }
        });

        return redirect()->route('hod.thesis.index')->with('success', 'Thesis created successfully.');
    }

    public function edit(Thesis $thesis)
    {
        $departments = Department::all();

        if (auth()->user()->hod->department_id !== $thesis->department_id) {
            return redirect()->route('hod.thesis.index')->with('error', 'You are not allowed to edit theses from another department.');
        }

        // $keywords = Keyword::orderBy('keyword_name')->get();
        // $thesis->load('keywords');

        return view('hod.thesis.edit', compact('thesis', 'departments'));
    }

    public function update(Request $request, Thesis $thesis)
    {
        if (auth()->user()->hod->department_id !== $thesis->department_id) {
            return redirect()
                ->route('hod.thesis.index')->with('error', 'You are not allowed to edit theses from another department.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',
            'academic_year' => 'required|integer|digits:4',

            // 'keyword_ids' => 'nullable|array',
            // 'keyword_ids.*' => 'exists:keywords,id',

            'files' => 'nullable|array',
            'files.*' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        if ($request->filled('academic_year')) {
            $updateData['academic_year'] = $request->academic_year;
        }

        $thesis->update($updateData);

        DB::transaction(function () use ($request, $thesis) {

            $thesis->update([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'description' => $request->description,
                'author_name' => $request->author_name,
                'acadmic_year' => $request->acadmic_year,
            ]);

            // $thesis->keywords()->sync($request->keyword_ids ?? []);

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
                        'file_name' => $thesis->title.'.pdf',
                        'file_type' => $file->getClientOriginalExtension(),
                        'file_path' => $path,
                        'uploaded_at' => now(),
                    ]);
                }
            }
        });

        return redirect()->route('hod.thesis.index')->with('success', 'Thesis updated successfully.');
    }

    public function viewPDF(ThesisFile $file)
    {
        if (! Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(
            storage_path('app/public/'.$file->file_path)
        );
    }

    public function destroy(Thesis $thesis)
    {
        if (auth()->user()->hod->department_id !== $thesis->department_id) {
            return redirect()
                ->route('hod.thesis.index')->with('error', 'You are not allowed to delete theses from another department.');
        }

        DB::transaction(function () use ($thesis) {
            // delete associated files from storage and database
            foreach ($thesis->files as $file) {
                Storage::disk('public')->delete($file->file_path);
                $file->delete();
            }

            $thesis->delete();
        });

        return redirect()->route('hod.thesis.index')->with('success', 'Thesis deleted successfully.');
    }

    public function myTheses()
    {
        $department_id = auth()->user()->hod->department_id;

        $theses = Thesis::where('department_id', $department_id)
            ->where('published_by', auth()->id())
            ->with('files')
            ->get();

        return view('hod.thesis.my-theses', compact('theses'));
    }

    public function show(Thesis $thesis)
    {

        if (
            is_null($thesis->published_at) ||
            ! $thesis->publishedBy ||
            ! in_array($thesis->publishedBy->role, ['admin', 'hod'], true)
        ) {
            abort(404);
        }

        // Load relationships needed by show.blade.php.
        $thesis->load([
            'department',
            'publishedBy',
            'files',
        ]);

        return view(
            'hod.thesis.show',
            compact('thesis')
        );
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
                    })

                    // Submitted By
                    ->orWhereHas('submittedBy', function ($u) use ($search) {

                        // Admin username
                        $u->where('username', 'like', "%{$search}%")

                            // Student full name
                            ->orWhereHas('student', function ($s) use ($search) {
                                $s->where('full_name', 'like', "%{$search}%");
                            })

                            // HoD full name
                            ->orWhereHas('hod', function ($h) use ($search) {
                                $h->where('full_name', 'like', "%{$search}%");
                            });
                    })

                    // Published By
                    ->orWhereHas('publishedBy', function ($u) use ($search) {

                        // Admin username
                        $u->where('username', 'like', "%{$search}%")

                            // Student full name
                            ->orWhereHas('student', function ($s) use ($search) {
                                $s->where('full_name', 'like', "%{$search}%");
                            })

                            // HoD full name
                            ->orWhereHas('hod', function ($h) use ($search) {
                                $h->where('full_name', 'like', "%{$search}%");
                            });
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
            $query->where('academic_year', $request->year);
            // $query->whereYear('published_at', $request->year);
        }

        $theses = $query->get();

        return view('hod.thesis.table', compact('theses'));
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
}
