<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\SavedThesis;
use App\Models\Thesis;
use App\Models\ThesisFile;
use App\Models\ViewHistory;
use Illuminate\Http\Request;
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
        $academicYears = Thesis::whereNotNull('academic_year')
            ->select('academic_year')
            ->distinct()
            ->orderByDesc('academic_year')
            ->pluck('academic_year');

        $savedThesisIds = SavedThesis::where(
            'user_id',
            auth()->id()
        )
            ->pluck('thesis_id')
            ->toArray();

        return view('student.thesis.index', compact('theses', 'savedThesisIds', 'departments', 'academicYears'));
    }

    public function viewPDF(ThesisFile $file)
    {
        $thesis = $file->thesis;

        if (! $thesis) {
            return redirect()
                ->back()
                ->with('error', 'Thesis not found.');
        }

        if (! Storage::disk('public')->exists($file->file_path)) {
            return redirect()
                ->back()
                ->with('error', 'File not found.');
        }

        ViewHistory::create([
            'user_id' => auth()->id(),
            'thesis_id' => $thesis->id,
            'viewed_at' => now(),
        ]);

        return response()->file(
            storage_path(
                'app/public/' . $file->file_path
            )
        );
    }

    public function show(Thesis $thesis)
    {
        $thesis->load([
            'files',
            'department',
        ]);

        return view('student.thesis.show', compact('thesis'));
    }

    public function myTheses()
    {
        $theses = Thesis::where('submitted_by', auth()->id())
            ->with('files')
            ->latest()
            ->get();

        return view('student.my_thesis.my-theses', compact('theses'));
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


        if ($request->filled('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%")
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

                    ->orWhereHas(
                        'publishedBy',
                        function ($u) use ($search) {
                            $u->where('username', 'like', "%{$search}%")
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

        $savedThesisIds = SavedThesis::where(
            'user_id',
            auth()->id()
        )
            ->pluck('thesis_id')
            ->toArray();

        return view('student.thesis.table', compact('theses', 'savedThesisIds'));
    }

    public function downloadPDF(ThesisFile $file)
    {
        $filePath = storage_path(
            'app/public/' . $file->file_path
        );

        if (! file_exists($filePath)) {
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

        return response()->download($filePath, $fileName);
    }

    public function history()
    {
        $histories = ViewHistory::with([
            'thesis.files',
        ])
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest('viewed_at')
            ->get();

        return view('student.history.view_history', compact('histories'));
    }
}