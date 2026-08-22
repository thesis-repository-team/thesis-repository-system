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
}
