<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SavedThesis;
use App\Models\Thesis;
use App\Models\ThesisRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;

        $totalTheses = Thesis::where(
            'student_id',
            $student->id
        )->count();

        $publishedTheses = Thesis::where(
            'student_id',
            $student->id
        )
            ->whereNotNull('published_at')
            ->count();

        $totalRequests = ThesisRequest::where(
            'submitted_by',
            auth()->id()
        )->count();

        $savedTheses = SavedThesis::where(
            'user_id',
            auth()->id()
        )->count();

        $recentTheses = Thesis::where(
            'student_id',
            $student->id
        )
            ->latest()
            ->take(5)
            ->get();

        $recentRequests = ThesisRequest::where(
            'submitted_by',
            auth()->id()
        )
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'totalTheses',
            'publishedTheses',
            'totalRequests',
            'savedTheses',
            'recentTheses',
            'recentRequests'
        ));
    }
}
