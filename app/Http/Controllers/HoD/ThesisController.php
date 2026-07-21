<?php

namespace App\Http\Controllers\HoD;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\Department;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function index()
    {
        $theses = Thesis::where('published_by', auth()->id())->get();
        return view('hod.thesis.index', compact('theses'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('hod.thesis.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'author_name' => 'required|string|max:255',
        ]);

        Thesis::create([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'author_name' => $request->author_name,
            'submitted_by' => auth()->id(),
            'published_by' => auth()->id(),
            'published_at' => now(),
        ]);

        return redirect()->route('hod.thesis.index')->with('success', 'Thesis created successfully.');
    }

    public function edit(Thesis $thesis)
    {
        $departments = Department::all();
        return view('hod.thesis.edit', compact('thesis', 'departments'));
    }

    public function update(Request $request, Thesis $thesis)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'author_name' => 'required|string|max:255',
        ]);

        $thesis->update([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'author_name' => $request->author_name,
        ]);

        return redirect()->route('hod.thesis.index')->with('success', 'Thesis updated successfully.');
    }


    
}
