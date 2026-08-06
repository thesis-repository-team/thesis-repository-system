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

        return view('student.thesis.index', compact('theses'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('student.thesis.create', compact('departments'));
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

            // change from hod to student
            $department_id = auth()->user()->student->department_id;
            $thesis = Thesis::create([
                'title' => $request->title,
                'abstract' => $request->abstract,
                'description' => $request->description,
                'department_id' => $department_id,
                'author_name' => $request->author_name,
                'submitted_by' => auth()->id(),
                'published_by' => auth()->id(),
                'published_at' => now(),
            ]);

            foreach ($request->file('files') as $file) {
                $path = $file->store('thesis_files', 'public');
                ThesisFile::create([
                    'thesis_id' => $thesis->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_path' => $path,
                    'uploaded_at' => now(),
                ]);
            }
        });

        return redirect()->route('student.thesis.index')->with('success', 'Thesis created successfully.');
    }

    public function edit(Thesis $thesis)
    {
        $departments = Department::all();

        if (auth()->user()->student->department_id !== $thesis->department_id) {
            return redirect()->route('student.thesis.index')->with('error', 'You are not allowed to edit theses from another department.');
        }

        return view('student.thesis.edit', compact('thesis', 'departments'));
    }

    public function update(Request $request, Thesis $thesis)
    {
        if (auth()->user()->student->department_id !== $thesis->department_id) {
            return redirect()
                ->route('student.thesis.index')->with('error', 'You are not allowed to edit theses from another department.');
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
                        'file_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientOriginalExtension(),
                        'file_path' => $path,
                        'uploaded_at' => now(),
                    ]);
                }
            }
        });

        return redirect()->route('student.thesis.index')->with('success', 'Thesis updated successfully.');
    }

    public function viewPDF(ThesisFile $file)
    {
        if (! Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(storage_path('app/public/' . $file->file_path));
    }

    public function destroy(Thesis $thesis)
    {
        if (auth()->user()->student->department_id !== $thesis->department_id) {
            return redirect()
                ->route('student.thesis.index')->with('error', 'You are not allowed to delete theses from another department.');
        }

        DB::transaction(function () use ($thesis) {
            // delete associated files from storage and database
            foreach ($thesis->files as $file) {
                Storage::disk('public')->delete($file->file_path);
                $file->delete();
            }

            $thesis->delete();
        });

        return redirect()->route('student.thesis.index')->with('success', 'Thesis deleted successfully.');
    }

    public function myTheses()
    {
        // $department_id = auth()->user()->hod->department_id;
        // $theses = Thesis::where('department_id', $department_id)->with('files')->get();

        $department_id = auth()->user()->student->department_id;

        $theses = Thesis::where('department_id', $department_id)
            ->where('published_by', auth()->id())
            ->with('files')
            ->get();

        return view('student.thesis.my-theses', compact('theses'));
    }
}
