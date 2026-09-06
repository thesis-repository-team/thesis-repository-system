<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use App\Models\Department;

class WelcomeController extends Controller
{
    public function index()
    {
        $query = Thesis::with([
            'department',
            'submittedBy',
            'publishedBy',
            'files'
        ])
            ->whereNotNull('published_at')
            ->orderByDesc('published_at');

        if (request()->filled('search')) {
            $search = request('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author_name', 'like', '%' . $search . '%')
                    ->orWhereHas('department', function ($department) use ($search) {
                        $department->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $theses = $query->paginate(10)->withQueryString();

        $recentTheses = Thesis::with([
            'department',
            'files'
        ])
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $totalTheses = Thesis::whereNotNull('published_at')->count();

        $totalDepartments = Department::count();

        $totalAuthors = Thesis::whereNotNull('published_at')
            ->whereNotNull('author_name')
            ->distinct('author_name')
            ->count('author_name');

        return view('welcome', compact(
            'theses',
            'recentTheses',
            'totalTheses',
            'totalDepartments',
            'totalAuthors'
        ));
    }
}