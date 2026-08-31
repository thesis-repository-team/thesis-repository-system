<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thesis;
use App\Models\Student;
use App\Models\User;
use App\Models\SavedThesis;

class SavedThesisController extends Controller
{
    // Display saved thesis
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        $savedTheses = SavedThesis::with('thesis')
            ->where('student_id', $student->id)
            ->latest('saved_at')
            ->get();

        return view('student.saved_thesis.index', compact('savedTheses'));
    }

    // Save thesis
    public function store(Request $request, Thesis $thesis)
    {
        $student = Student::where('user_id', auth()->id())->firstOrFail();

        // Check if already saved
        $alreadySaved = SavedThesis::where('student_id', $student->id)
            ->where('thesis_id', $thesis->id)
            ->exists();
        if ($alreadySaved) {
            return back()->with('info', 'This thesis is already saved.');
        } SavedThesis::create(['student_id' => $student->id, 'thesis_id' => $thesis->id, 'saved_at' => now()]);

        return back()->with('success', 'Thesis saved successfully.');
    }

    // Remove saved thesis
    public function destroy(Thesis $thesis)
    {
        $student = Student::where('user_id', auth()->id())
            ->firstOrFail();
        SavedThesis::where('student_id', $student->id)
            ->where('thesis_id', $thesis->id)->delete();

        return back()->with('success', 'Thesis removed from saved theses.');
    }

    // add search function to search for theses by title, author_name, or department name
//     public function search(Request $request)
//     {
//         $search = $request->search;
//         $query = Thesis::with(['user', 'department']);

//         // Search
//         if ($request->filled('search')) {
//             $query->where(function ($q) use ($search) {
//                 $q->where('title', 'like', "%{$search}%")
//                     ->orWhere('author_name', 'like', "%{$search}%")
//                     ->orWhereHas('department', function ($d) use ($search) {
//                         $d->where('name', 'like', "%{$search}%");
//                     })

//                     //Keyword
//                     ->orWhereHas('keywords', function ($k) use ($search) {
//                         $k->where('keyword_name', 'like', "%{$search}%");
//                     })

//                     // Submitted By
//                     ->orWhereHas('submittedBy', function ($u) use ($search) {

//                         // Admin username
//                         $u->where('username', 'like', "%{$search}%")

//                             // Student full name
//                             ->orWhereHas('student', function ($s) use ($search) {
//                                 $s->where('full_name', 'like', "%{$search}%");
//                             })

//                             // HoD full name
//                             ->orWhereHas('hod', function ($h) use ($search) {
//                                 $h->where('full_name', 'like', "%{$search}%");
//                             });
//                     })

//                     // Published By
//                     ->orWhereHas('publishedBy', function ($u) use ($search) {

//                         // Admin username
//                         $u->where('username', 'like', "%{$search}%")

//                             // Student full name
//                             ->orWhereHas('student', function ($s) use ($search) {
//                                 $s->where('full_name', 'like', "%{$search}%");
//                             })

//                             // HoD full name
//                             ->orWhereHas('hod', function ($h) use ($search) {
//                                 $h->where('full_name', 'like', "%{$search}%");
//                             });
//                     });
//             });
//         }

//         // department filter
//         if ($request->filled('department')) {
//             $query->whereHas('department', function ($q) use ($request) {
//                 $q->where('name', $request->department);
//             });
//         }

//         // year filter
//         if ($request->filled('year')) {
//             $query->whereYear('published_at', $request->year);
//         }

//         $theses = $query->get();

//         // Get all thesis IDs saved by this student
//         $savedThesisIds = SavedThesis::where('student_id', auth()->user()->student->id)
//             ->pluck('thesis_id')
//             ->toArray();

//         return view('student.thesis.table', compact('theses','savedThesisIds'));
//     }
}
