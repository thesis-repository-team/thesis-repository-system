<?php

namespace App\Http\Controllers\Admin;

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
        $theses = Thesis::with([
                'files',
                'department',
                'submittedBy',
                'publishedBy',
            ])
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->get();

        $departments = Department::all();

        /*
        |--------------------------------------------------------------------------
        | Academic Years
        |--------------------------------------------------------------------------
        | academic_year contains values such as:
        | 2012
        | 2015
        | 2020
        | 2024
        |
        | Do NOT use YEAR(published_at) here.
        */
        $academicYears = Thesis::whereNotNull('academic_year')
            ->select('academic_year')
            ->distinct()
            ->orderByDesc('academic_year')
            ->pluck('academic_year');

        return view('admin.thesis.index', compact(
            'theses',
            'departments',
            'academicYears'
        ));
    }

    public function viewPDF(ThesisFile $file)
    {
        if (!Storage::disk('public')->exists($file->file_path)) {
            return redirect()
                ->back()
                ->with('error', 'File not found.');
        }

        return response()->file(
            storage_path('app/public/' . $file->file_path)
        );
    }

    public function show(Thesis $thesis)
    {
        if (
            is_null($thesis->published_at) ||
            !$thesis->publishedBy ||
            !in_array($thesis->publishedBy->role, ['admin', 'hod'], true)
        ) {
            abort(404);
        }

        $thesis->load([
            'department',
            'publishedBy',
            'files',
        ]);

        return view(
            'admin.thesis.show',
            compact('thesis')
        );
    }

    public function create()
    {
        $departments = Department::all();

        return view(
            'admin.thesis.create',
            compact('departments')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',

            // Single academic year, e.g. 2012
            'academic_year' => 'required|integer|digits:4',

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
                'academic_year' => $request->academic_year,
                'submitted_by' => auth()->id(),
                'published_by' => auth()->id(),
                'published_at' => now(),
            ]);

            foreach ($request->file('files') as $file) {

                $path = $file->store(
                    'thesis_files',
                    'public'
                );

                ThesisFile::create([
                    'thesis_id' => $thesis->id,
                    'file_name' => $thesis->title . '.pdf',
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $path,
                    'uploaded_at' => now(),
                ]);
            }
        });

        return redirect()
            ->route('admin.thesis.index')
            ->with('success', 'Thesis created successfully.');
    }

    public function edit(Thesis $thesis)
    {
        $departments = Department::all();

        return view(
            'admin.thesis.edit',
            compact('thesis', 'departments')
        );
    }

    public function update(Request $request, Thesis $thesis)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'author_name' => 'required|string|max:255',

            // Optional during edit.
            // Existing value is preserved if left empty.
            'academic_year' => 'nullable|integer|digits:4',

            'files' => 'nullable|array',
            'files.*' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        DB::transaction(function () use ($request, $thesis) {

            $updateData = [
                'title' => $request->title,
                'abstract' => $request->abstract,
                'description' => $request->description,
                'author_name' => $request->author_name,
            ];

            /*
            |--------------------------------------------------------------------------
            | Academic Year
            |--------------------------------------------------------------------------
            | Only update it when the user entered a value.
            | This prevents academic_year from becoming NULL.
            */
            if ($request->filled('academic_year')) {
                $updateData['academic_year'] =
                    $request->academic_year;
            }

            $thesis->update($updateData);

            /*
            |--------------------------------------------------------------------------
            | Replace PDF files only when new files are uploaded
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('files')) {

                foreach ($thesis->files as $oldFile) {

                    Storage::disk('public')->delete(
                        $oldFile->file_path
                    );

                    $oldFile->delete();
                }

                foreach ($request->file('files') as $file) {

                    $path = $file->store(
                        'thesis_files',
                        'public'
                    );

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

        return redirect()
            ->route('admin.thesis.index')
            ->with('success', 'Thesis updated successfully.');
    }

    public function destroy(Thesis $thesis)
    {
        DB::transaction(function () use ($thesis) {

            foreach ($thesis->files as $file) {

                Storage::disk('public')->delete(
                    $file->file_path
                );

                $file->delete();
            }

            $thesis->delete();
        });

        return redirect()
            ->route('admin.thesis.index')
            ->with('success', 'Thesis deleted successfully.');
    }

    public function myUpload()
    {
        $theses = Thesis::where(
                'published_by',
                auth()->id()
            )
            ->with([
                'files',
                'department',
            ])
            ->latest()
            ->get();

        return view(
            'admin.thesis.my-upload',
            compact('theses')
        );
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $query = Thesis::with([
            'files',
            'department',
            'submittedBy',
            'publishedBy',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'author_name',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'department',
                    function ($d) use ($search) {

                        $d->where(
                            'name',
                            'like',
                            "%{$search}%"
                        );
                    }
                )

                /*
                |--------------------------------------------------------------------------
                | Submitted By
                |--------------------------------------------------------------------------
                */
                ->orWhereHas(
                    'submittedBy',
                    function ($u) use ($search) {

                        $u->where(
                            'username',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhereHas(
                            'student',
                            function ($s) use ($search) {

                                $s->where(
                                    'full_name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        )

                        ->orWhereHas(
                            'hod',
                            function ($h) use ($search) {

                                $h->where(
                                    'full_name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        );
                    }
                )

                /*
                |--------------------------------------------------------------------------
                | Published By
                |--------------------------------------------------------------------------
                */
                ->orWhereHas(
                    'publishedBy',
                    function ($u) use ($search) {

                        $u->where(
                            'username',
                            'like',
                            "%{$search}%"
                        )

                        ->orWhereHas(
                            'student',
                            function ($s) use ($search) {

                                $s->where(
                                    'full_name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        )

                        ->orWhereHas(
                            'hod',
                            function ($h) use ($search) {

                                $h->where(
                                    'full_name',
                                    'like',
                                    "%{$search}%"
                                );
                            }
                        );
                    }
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | DEPARTMENT FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('department')) {

            $query->whereHas(
                'department',
                function ($q) use ($request) {

                    $q->where(
                        'name',
                        $request->department
                    );
                }
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ACADEMIC YEAR FILTER
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | academic_year already contains a single year such as 2012.
        |
        | Correct:
        | where('academic_year', $request->year)
        |
        | Do NOT use:
        | whereYear('academic_year', ...)
        |
        |--------------------------------------------------------------------------
        */
        if ($request->filled('year')) {

            $query->where(
                'academic_year',
                $request->year
            );
        }

        $theses = $query
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->get();

        return view(
            'admin.thesis.table',
            compact('theses')
        );
    }

    public function downloadPDF(ThesisFile $file)
    {
        $filePath = storage_path(
            'app/public/' . $file->file_path
        );

        if (!file_exists($filePath)) {

            return back()->with(
                'error',
                'PDF file not found.'
            );
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