<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return match (Auth::user()->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'hod'     => redirect()->route('hod.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default   => abort(403),
        };
    }
}
