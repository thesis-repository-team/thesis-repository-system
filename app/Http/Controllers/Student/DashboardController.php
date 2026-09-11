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
        $user = auth()->user();

        // Student record exists only for students
        $student = $user->student;

        // Repository statistics
        $totalTheses = Thesis::count();

        $publishedTheses = Thesis::whereNotNull('published_at')->count();

        // Only students can submit thesis requests
        $totalRequests = 0;

        if ($user->role === 'student') {
            $totalRequests = ThesisRequest::where(
                'submitted_by',
                $user->id
            )->count();
        }

        // Bookmarks belong to users
        // Both students and guests can have bookmarks
        // $savedTheses = SavedThesis::where(
        //     'user_id',
        //     $user->id
        // )->count();

        // Recent published theses
        $recentTheses = Thesis::whereNotNull('published_at')
            ->latest('published_at')
            ->take(5)
            ->get();

        // Recent requests only for students
        $recentRequests = collect();

        if ($user->role === 'student') {
            $recentRequests = ThesisRequest::where(
                'submitted_by',
                $user->id
            )
                ->latest()
                ->take(5)
                ->get();
        }

        return view('student.dashboard', compact(
            'totalTheses',
            'publishedTheses',
            'totalRequests',
            // 'savedTheses',
            'recentTheses',
            'recentRequests',
            'student'
        ));
    }
}





// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $student = auth()->user()->student;

//         $totalTheses = Thesis::where(
//             'student_id',
//             $student->id
//         )->count();

//         $publishedTheses = Thesis::where(
//             'student_id',
//             $student->id
//         )
//             ->whereNotNull('published_at')
//             ->count();

//         $totalRequests = ThesisRequest::where(
//             'submitted_by',
//             auth()->id()
//         )->count();

//         $savedTheses = SavedThesis::where(
//             'user_id',
//             auth()->id()
//         )->count();

//         $recentTheses = Thesis::where(
//             'student_id',
//             $student->id
//         )
//             ->latest()
//             ->take(5)
//             ->get();

//         $recentRequests = ThesisRequest::where(
//             'submitted_by',
//             auth()->id()
//         )
//             ->latest()
//             ->take(5)
//             ->get();

//         return view('student.dashboard', compact(
//             'totalTheses',
//             'publishedTheses',
//             'totalRequests',
//             'savedTheses',
//             'recentTheses',
//             'recentRequests'
//         ));
//     }
// }