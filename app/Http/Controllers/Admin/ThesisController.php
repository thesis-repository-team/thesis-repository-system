<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Thesis;
use App\Models\ThesisFile;

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
        if (! \Illuminate\Support\Facades\Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(storage_path('app/public/' . $file->file_path));
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
}
