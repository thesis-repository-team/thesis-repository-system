<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SavedThesis;
use App\Models\Thesis;
use Illuminate\Http\Request;

class SavedThesisController extends Controller
{
    public function index()
    {
        $savedTheses = SavedThesis::with('thesis')
            ->where('user_id', auth()->id())
            ->latest('saved_at')
            ->get();

        return view('student.saved_thesis.index', compact('savedTheses'));
    }

    public function store(Request $request, Thesis $thesis)
    {
        $alreadySaved = SavedThesis::where('user_id', auth()->id())
            ->where('thesis_id', $thesis->id)
            ->exists();

        if (!$alreadySaved) {
            SavedThesis::create([
                'user_id' => auth()->id(),
                'thesis_id' => $thesis->id,
                'saved_at' => now(),
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'saved' => true,
                'message' => $alreadySaved
                    ? 'This thesis is already saved.'
                    : 'Thesis saved successfully.',
            ]);
        }

        return back()->with(
            $alreadySaved ? 'info' : 'success',
            $alreadySaved
                ? 'This thesis is already saved.'
                : 'Thesis saved successfully.'
        );
    }

    public function destroy(Request $request, Thesis $thesis)
    {
        SavedThesis::where('user_id', auth()->id())
            ->where('thesis_id', $thesis->id)
            ->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'saved' => false,
                'message' => 'Thesis removed from saved theses.',
            ]);
        }

        return back()->with(
            'success',
            'Thesis removed from saved theses.'
        );
    }
}
