<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thesis;
use App\Models\ThesisFile;

class ThesisController extends Controller
{
    //
    public function index()
    {
        $theses = Thesis::latest()->get();
        return view('admin.thesis.index', compact('theses'));
    }

    public function viewPDF(ThesisFile $file)
    {
        if (! \Illuminate\Support\Facades\Storage::disk('public')->exists($file->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file(storage_path('app/public/' . $file->file_path));
    }
}
